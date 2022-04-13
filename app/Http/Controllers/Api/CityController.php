<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\PaginationResource;
use App\Models\City;
use App\Models\Log;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class CityController extends Controller
{
    use ApiResponse;

    public function getAllCities()
    {
        $cities = City::paginate(8);

        $cities->transform(function ($city) {
            return new CityResource($city);
        });

        if ($cities->isNotEmpty()) {
            return $this->apiResponse('', new PaginationResource($cities), 200);
        } else {
            return $this->apiResponse('', [], 200);
        }
    }

    public function createCity(Request $request)
    {
        $user = auth()->user();

        $data = $request->all();

        $validator = Validator::make($data, [
            'name_ar'    => 'required|min:3|unique:cities,name_ar',
            'name_en'    => 'required|min:3|unique:cities,name_en',
            'country_id' => 'required',
        ], [
            'name_ar.required'    => __('name_ar_required'),
            'name_ar.min'         => __('name_ar_min'),
            'name_ar.unique'      => __('name_ar_unique'),
            'name_en.required'    => __('name_en_required'),
            'name_en.min'         => __('name_en_min'),
            'name_en.unique'      => __('name_en_unique'),
            'country_id.required' => __('country_id_required'),
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return $this->apiResponse($validator->errors()->all()[0], [], 422);
        }

        $city = City::create($data);

        Log::create([
            'user_id' => $user->id,
            'message_ar' => 'بإضافة مدينة جديدة ' . $user->first_name . ' ' . $user->family_name . ' قام الموظف ',
            'message_en' => 'The employee ' . $user->first_name . ' ' . $user->family_name . ' added a new City',
            'date' => Carbon::now(),
        ]);

        if ($city) {
            return $this->apiResponse(__('created_successfully'), new CityResource($city), 201);
        }
    }

    public function updateCity(Request $request, $id)
    {
        $user = auth()->user();

        $city = City::find($id);

        if ($city) {

            $data = $request->all();

            $validator = Validator::make($data, [
                'name_ar'    => 'required|min:3|unique:cities,name_ar,' . $id,
                'name_en'    => 'required|min:3|unique:cities,name_en,' . $id,
                'country_id' => 'required',
            ], [
                'name_ar.required'    => __('name_ar_required'),
                'name_ar.min'         => __('name_ar_min'),
                'name_ar.unique'      => __('name_ar_unique'),
                'name_en.required'    => __('name_en_required'),
                'name_en.min'         => __('name_en_min'),
                'name_en.unique'      => __('name_en_unique'),
                'country_id.required' => __('country_id_required'),
            ]);

            if ($validator->stopOnFirstFailure()->fails()) {
                return $this->apiResponse($validator->errors()->all()[0], [], 422);
            }

            $city->update($data);

            Log::create([
                'user_id' => $user->id,
                'message_ar' => 'بتعديل المدينة ' . $city->name_ar . ' ' . $user->first_name . ' ' . $user->family_name . ' قام الموظف ',
                'message_en' => 'The employee ' . $user->first_name . ' ' . $user->family_name . ' updated city ' . $city->name_en,
                'date' => Carbon::now(),
            ]);

            return $this->apiResponse(__('updated_successfully'), new CityResource($city), 200);
        } else {
            return $this->apiResponse(__('city_not_found'), [], 404);
        }

    }

    public function deleteCity($id)
    {
        $user = auth()->user();

        $city = City::find($id);

        if ($city) {

            $city->delete();

            Log::create([
                'user_id' => $user->id,
                'message_ar' => 'بحذف المدينة ' . $city->name_ar . ' ' . $user->first_name . ' ' . $user->family_name . ' قام الموظف ',
                'message_en' => 'The employee ' . $user->first_name . ' ' . $user->family_name . ' deleted city ' . $city->name_en,
                'date' => Carbon::now(),
            ]);

            return $this->apiResponse(__('deleted_successfully'), [], 200);
        } else {
            return $this->apiResponse(__('city_not_found'), [], 404);
        }
    }
}
