<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
{
    public function messages()
    {
        return [
            'name_ar.required' => __('name_ar_required'),
            'name_ar.min'      => __('name_ar_min'),
            'name_en.required' => __('name_en_required'),
            'name_en.min'      => __('name_en_min'),
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
            'name_ar' => 'required|min:3',
            'name_en' => 'required|min:3',
        ];
    }
}
