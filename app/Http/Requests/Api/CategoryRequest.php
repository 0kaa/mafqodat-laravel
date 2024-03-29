<?php

namespace App\Http\Requests\Api;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends MasterApiRequest
{
    public function messages()
    {
        return [

            'name_ar.required'    => __('name_ar_required'),
            'name_en.required'    => __('name_ar_required'),
            'storage_id.required' => __('storage_required'),

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
        return Category::rules();
    }
}
