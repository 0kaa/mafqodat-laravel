<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends MasterApiRequest
{
    public function messages()
    {
        return [
            'details.required'           => __('details_required'),
            'category_id.required'       => __('category_id_required'),
            'station_id.required'        => __('station_id_required'),
            // 'storage_id.required'        => __('storage_required'),
            'date.required'              => __('date_required'),
            'time.required'              => __('time_required'),
            'report_type.required'       => __('report_type_required'),
            'informer_name.required_if'  => __('informer_name_required'),
            'informer_phone.required_if' => __('informer_phone_required'),
            'first_name.required_if'     => __('first_name_required'),
            'surname.required_if'        => __('family_name_required'),
            'email.required_if'          => __('email_required'),
            'address.required_if'        => __('address_required'),
            'postcode.required_if'       => __('postcode_required'),
            'city.required_if'           => __('city_required'),
            'phone.required_if'          => __('phone_required'),
            'mobile.required_if'         => __('mobile_required'),
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
            /* items data */
            'details'          => 'required',
            'category_id'      => 'required',
            'station_id'       => 'required',
            // 'storage_id'       => 'required',
            'date'             => 'required',
            'time'             => 'required',
            'is_delivered'     => 'sometimes',
            'report_type'      => 'required',
            'informer_name'    => 'required_if:report_type,found',
            'informer_phone'   => 'required_if:report_type,found',

            /* User data */
            'full_name'        => 'required_if:is_delivered,1',
            'phone'             => 'required_if:is_delivered,1',

        ];
    }
}
