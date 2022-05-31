<?php

namespace App\Http\Requests\Api;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends MasterApiRequest
{
    public function messages()
    {
        return [
            'first_name.required'  => __('first_name_required'),
            'family_name.required' => __('family_name_required'),
            'email.required'       => __('email_required'),
            'email.unique'         => __('email_unique'),
            'password.required'    => __('password_required'),
            'password.min'         => __('password_min'),
            'phone.required'       => __('phone_required'),
            'address.required'     => __('address_required'),
            'phone.required'       => __('phone_required'),
            'mobile.required'      => __('mobile_required'),
            'city.required'        => __('city_required'),

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
       return User::rules();
    }
}
