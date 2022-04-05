<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StationRequest extends FormRequest
{
    public function messages()
    {
        return [
            'type.required'     => __('type_required'),
            'name_ar.required'  => __('name_ar_required'),
            'name_en.required'  => __('name_en_required'),
            'details.required'  => __('details_required'),
            'number.required'   => __('number_required'),
            'number.numeric'    => __('number_numeric'),
            'number.unique'     => __('number_unique'),
            'location.required' => __('location_required'),
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type'        => 'required|in:metro,bus',
            'name_ar'     => 'required',
            'name_en'     => 'required',
            'number'      => 'required|numeric|unique:stations,number,'.$this->id,
            'description' => 'sometimes',
            'location'    => 'required',
            // 'lat'         => 'required',
            // 'lng'         => 'required',

        ];
    }
}
