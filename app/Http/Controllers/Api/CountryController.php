<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CountryRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Validator;

class CountryController extends Controller
{
    use ApiResponse;

    public function getAllCountries()
    {
        $countries = Country::get();

        if ($countries->isNotEmpty()) {
            return $this->apiResponse('', CountryResource::collection($countries), 200);
        }
    }

    public function createCountry(CountryRequest $request)
    {
        $data = $request->all();

        $country = Country::create($data);

        if ($country) {
            return $this->apiResponse(__('created_successfully'), new CountryResource($country), 201);
        }
    }

    public function updateCountry(Request $request, $id)
    {
        $country = Country::find($id);

        if ($country) {

            $data = $request->validate([
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

            $country->update($data);

            return $this->apiResponse(__('updated_successfully'), [new CountryResource($country)], 200);
        } else {
            return $this->apiResponse(__('country_not_found'), [], 404);
        }
    }

    public function deleteCountry($id)
    {
        $country = Country::find($id);

        if ($country) {

            $country->delete();

            return $this->apiResponse(__('deleted_successfully'), [], 200);
        } else {
            return $this->apiResponse(__('country_not_found'), [], 404);
        }
    }

}
