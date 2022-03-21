<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function messages()
    {
        return [

            'name_ar.required' => __('name_ar_required'),
            'name_en.required' => __('name_ar_required'),
            'image.required'   => __('image_required'),

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

        switch (request()->method()) {
            case 'POST':

                return [
                    'name_ar' => 'required',
                    'name_en' => 'required',
                    'image'   => 'required'
                ];

                break;

            case 'PUT':

                return [
                    'name_ar' => 'required',
                    'name_en' => 'required',
                    'image'   => 'sometimes'
                ];

                break;
        }

    }
}
