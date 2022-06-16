<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{

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
            'category_id' => 'required',
            'station_id'  => 'required',
            'date'        => 'required',
            'time'        => 'required',
            'description' => 'sometimes',
            'image'       => 'sometimes',
            'report_type' => 'required',
            'storage_id'  => 'required_if:report_type,lost',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required'       => __('category_id_required'),
            'station_id.required'        => __('station_id_required'),
            'storage_id.required_id'        => __('storage_required'),
            'date.required'              => __('date_required'),
            'time.required'              => __('time_required'),
            'report_type.required'       => __('report_type_required'),
        ];
    }
}
