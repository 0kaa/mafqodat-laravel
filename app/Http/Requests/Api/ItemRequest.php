<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends MasterApiRequest
{
    public function messages()
    {
        return [
            'details.required'        => __('details_required'),
            'category_id.required'    => __('category_id_required'),
            'station_id.required'     => __('station_id_required'),
            'storage.required'        => __('storage_required'),
            'date.required'           => __('date_required'),
            'time.required'           => __('time_required'),
            'first_name.required_if'  => __('first_name_required'),
            'surname.required_if'     => __('family_name_required'),
            'email.required_if'       => __('email_required'),
            'address.required_if'     => __('address_required'),
            'postcode.required_if'    => __('postcode_required'),
            'city.required_if'        => __('city_required'),
            'phone.required_if'       => __('phone_required'),
            'mobile.required_if'      => __('mobile_required'),
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
            'storage'          => 'required',
            'date'             => 'required',
            'time'             => 'required',
            'primary_colour'   => 'sometimes',
            'secondary_colour' => 'sometimes',
            'tertiary_colour'  => 'sometimes',
            'description'      => 'sometimes',
            'image'            => 'sometimes',
            'is_delivered'     => 'sometimes',

            /* User data */
            'first_name'        => 'required_if:is_delivered,1',
            'surname'           => 'required_if:is_delivered,1',
            'address'           => 'required_if:is_delivered,1',
            'secondary_address' => 'sometimes',
            'city'              => 'required_if:is_delivered,1',
            'postcode'          => 'required_if:is_delivered,1',
            'phone'             => 'required_if:is_delivered,1',
            'mobile'            => 'required_if:is_delivered,1',
            'email'             => 'required_if:is_delivered,1',

        ];
    }
}
