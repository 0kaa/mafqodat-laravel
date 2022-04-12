<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CountryRequest;
use App\Http\Resources\CountryResource;
use App\Http\Resources\PaginationResource;
use App\Models\Country;
use App\Models\Log;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class CountryController extends Controller
{
    use ApiResponse;

    public function getAllCountries()
    {
        $countries = Country::paginate(10);

        $countries->transform(function ($country) {
            return new CountryResource($country);
        });

        if ($countries->isNotEmpty()) {
            return $this->apiResponse('', new PaginationResource($countries), 200);
        } else {
            return $this->apiResponse('', [], 200);
        }
    }

    public function createCountry(CountryRequest $request)
    {
        $user = auth()->user();

        $data = $request->all();

        $validator = Validator::make($data, [
            'name_ar' => 'required|min:3|unique:countries,name_ar',
            'name_en' => 'required|min:3|unique:countries,name_en',
        ], [
            'name_ar.required' => __('name_ar_required'),
            'name_ar.min'      => __('name_ar_min'),
            'name_ar.unique'   => __('name_ar_unique'),
            'name_en.required' => __('name_en_required'),
            'name_en.min'      => __('name_en_min'),
            'name_en.unique'   => __('name_en_unique'),
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return $this->apiResponse($validator->errors()->all()[0], [], 422);
        }

        $country = Country::create($data);

        Log::create([
            'image' => $user->image ? $user->image : null,
            'message_ar' => 'بإضافة دولة جديدة ' . $user->first_name . ' ' . $user->family_name . ' قام الموظف ',
            'message_en' => 'The employee ' . $user->first_name . ' ' . $user->family_name . ' added a new Country',
            'date' => Carbon::now(),
        ]);

        if ($country) {
            return $this->apiResponse(__('created_successfully'), new CountryResource($country), 201);
        }
    }

    public function updateCountry(Request $request, $id)
    {
        $user = auth()->user();

        $country = Country::find($id);

        if ($country) {

            $data = $request->all();

            $validator = Validator::make($data, [
                'name_ar' => 'required|min:3|unique:countries,name_ar,' . $id,
                'name_en' => 'required|min:3|unique:countries,name_en,' . $id,
            ], [
                'name_ar.required' => __('name_ar_required'),
                'name_ar.min'      => __('name_ar_min'),
                'name_ar.unique'   => __('name_ar_unique'),
                'name_en.required' => __('name_en_required'),
                'name_en.min'      => __('name_en_min'),
                'name_en.unique'   => __('name_en_unique'),
            ]);

            if ($validator->stopOnFirstFailure()->fails()) {
                return $this->apiResponse($validator->errors()->all()[0], [], 422);
            }

            $country->update($data);

            Log::create([
                'image' => $user->image ? $user->image : null,
                'message_ar' => 'بتعديل الدولة ' . $country->name_ar . ' ' . $user->first_name . ' ' . $user->family_name . ' قام الموظف ',
                'message_en' => 'The employee ' . $user->first_name . ' ' . $user->family_name . ' updated country ' . $country->name_en,
                'date' => Carbon::now(),
            ]);

            return $this->apiResponse(__('updated_successfully'), [new CountryResource($country)], 200);
        } else {
            return $this->apiResponse(__('country_not_found'), [], 404);
        }
    }

    public function deleteCountry($id)
    {
        $user = auth()->user();

        $country = Country::find($id);

        if ($country) {

            $country->delete();

            Log::create([
                'image' => $user->image ? $user->image : null,
                'message_ar' => 'بحذف الدولة ' . $country->name_ar . ' ' . $user->first_name . ' ' . $user->family_name . ' قام الموظف ',
                'message_en' => 'The employee ' . $user->first_name . ' ' . $user->family_name . ' deleted country ' . $country->name_en,
                'date' => Carbon::now(),
            ]);

            return $this->apiResponse(__('deleted_successfully'), [], 200);
        } else {
            return $this->apiResponse(__('country_not_found'), [], 404);
        }
    }

}
