<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\StationResource;
use App\Models\Log;
use App\Models\Station;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class StationController extends Controller
{
    use ApiResponse;

    public function getAllStations()
    {
        $stations = Station::paginate(8);

        $stations->transform(function ($station) {
            return new StationResource($station);
        });

        return $this->apiResponse('', new PaginationResource($stations), 200);
    }

    public function showStation($id)
    {
        $station = Station::find($id);

        if ($station) {
            return $this->apiResponse('', new StationResource($station), 200);
        } else {
            return $this->apiResponse(__('station_not_found'), [], 404);
        }
    }

    public function createStation(Request $request)
    {
        $user = auth()->user();

        $data = $request->all();

        $validator = Validator::make($data, [
            'type'        => 'required|in:metro,bus',
            'name_ar'     => 'required',
            'name_en'     => 'required',
            'number'      => 'required|numeric|unique:stations,number',
            'description' => 'sometimes',
            'location'    => 'required',
        ], [
            'type.required'     => __('type_required'),
            'name_ar.required'  => __('name_ar_required'),
            'name_en.required'  => __('name_en_required'),
            'number.required'   => __('number_required'),
            'number.numeric'    => __('number_numeric'),
            'number.unique'     => __('number_unique'),
            'location.required' => __('location_required'),
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return $this->apiResponse($validator->errors()->all()[0], [], 422);
        }

        $station = Station::create($data);

        Log::create([
            'user_id' => $user->id,
            'message_ar' => 'بإضافة محطة جديدة ' . $user->first_name . ' ' . $user->family_name . ' قام الموظف ',
            'message_en' => 'The employee ' . $user->first_name . ' ' . $user->family_name . ' added a new Station',
            'date' => Carbon::now(),
        ]);

        if ($station) {
            return $this->apiResponse(__('created_successfully'), new StationResource($station), 201);
        }
    }

    public function updateStation(Request $request, $id)
    {
        $user = auth()->user();

        $station = Station::find($id);

        if ($station) {

            $data = $request->all();

            $validator = Validator::make($data, [
                'type'        => 'required|in:metro,bus',
                'name_ar'     => 'required',
                'name_en'     => 'required',
                'number'      => 'required|numeric|unique:stations,number,' . $id,
                'description' => 'sometimes',
                'location'    => 'required',
            ], [
                'type.required'     => __('type_required'),
                'name_ar.required'  => __('name_ar_required'),
                'name_en.required'  => __('name_en_required'),
                'number.required'   => __('number_required'),
                'number.numeric'    => __('number_numeric'),
                'number.unique'     => __('number_unique'),
                'location.required' => __('location_required'),
            ]);

            if ($validator->stopOnFirstFailure()->fails()) {
                return $this->apiResponse($validator->errors()->all()[0], [], 422);
            }

            $station->update($data);

            Log::create([
                'user_id' => $user->id,
                'message_ar' => 'بتعديل المحطة ' . $station->name_ar . ' ' . $user->first_name . ' ' . $user->family_name . ' قام الموظف ',
                'message_en' => 'The employee ' . $user->first_name . ' ' . $user->family_name . ' updated station ' . $station->name_en,
                'date' => Carbon::now(),
            ]);

            return $this->apiResponse(__('updated_successfully'), new StationResource($station), 200);
        } else {
            return $this->apiResponse(__('station_not_found'), [], 404);
        }
    }

    public function deleteStation($id)
    {
        $user = auth()->user();

        $station = Station::find($id);

        if ($station) {

            $station->delete();

            Log::create([
                'user_id' => $user->id,
                'message_ar' => 'بحذف المحطة ' . $station->name_ar . ' ' . $user->first_name . ' ' . $user->family_name . ' قام الموظف ',
                'message_en' => 'The employee ' . $user->first_name . ' ' . $user->family_name . ' deleted station ' . $station->name_en,
                'date' => Carbon::now(),
            ]);

            return $this->apiResponse(__('deleted_successfully'), [], 200);
        } else {
            return $this->apiResponse(__('station_not_found'), [], 404);
        }
    }
}
