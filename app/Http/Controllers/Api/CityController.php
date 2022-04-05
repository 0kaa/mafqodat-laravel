<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Models\City;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CityController extends Controller
{
    use ApiResponse;

    public function getAllCities()
    {
        $cities = City::get();

        if ($cities->isNotEmpty()) {
            return $this->apiResponse('', CityResource::collection($cities), 200);
        } else {
            return $this->apiResponse('', [], 200);
        }
    }

    public function createCity(Request $request)
    {
        $data = $request->validate([
            'name_ar' => 'required|min:3|unique:cities,name_ar',
            'name_en' => 'required|min:3|unique:cities,name_en',
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

        $city = City::create($data);

        if ($city) {
            return $this->apiResponse(__('created_successfully'), new CityResource($city), 201);
        }
    }

    public function updateCity(Request $request, $id)
    {
        $city = City::find($id);

        if ($city) {

            $data = $request->validate([
                'name_ar' => 'required|min:3|unique:cities,name_ar,' . $city->id,
                'name_en' => 'required|min:3|unique:cities,name_en,' . $city->id,
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

            $city->update($data);

            return $this->apiResponse(__('updated_successfully'), new CityResource($city), 200);
        } else {
            return $this->apiResponse(__('city_not_found'), [], 404);
        }

    }

    public function deleteCity($id)
    {
        $city = City::find($id);

        if ($city) {

            $city->delete();

            return $this->apiResponse(__('deleted_successfully'), [], 200);
        } else {
            return $this->apiResponse(__('city_not_found'), [], 404);
        }
    }
}
