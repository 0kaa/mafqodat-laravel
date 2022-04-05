<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StationResource;
use App\Models\Station;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class StationController extends Controller
{
    use ApiResponse;

    public function getAllStations()
    {
        $stations = Station::get();

        if ($stations->isNotEmpty()) {
            return $this->apiResponse('', StationResource::collection($stations), 200);
        }
    }

    public function createStation(Request $request)
    {
        $data = $request->validate([
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

        $station = Station::create($data);

        if ($station) {
            return $this->apiResponse(__('created_successfully'), new StationResource($station), 201);
        }
    }

    public function updateStation(Request $request, $id)
    {
        $station = Station::find($id);

        if ($station) {

            $data = $request->validate([
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

            $station->update($data);

            return $this->apiResponse(__('updated_successfully'), new StationResource($station), 200);
        } else {
            return $this->apiResponse(__('station_not_found'), [], 404);
        }
    }

    public function deleteStation($id)
    {
        $station = Station::find($id);

        if ($station) {
            $station->delete();

            return $this->apiResponse(__('deleted_successfully'), [], 200);
        } else {
            return $this->apiResponse(__('station_not_found'), [], 404);
        }
    }

}
