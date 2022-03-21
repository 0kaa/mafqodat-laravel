<?php

namespace App\Http\Requests\Dashboard;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'country_id.required'     => __('country_required'),
            'city_id.required'        => __('city_required'),

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

                return User::rules();

                break;

            case 'PUT':

                return [
                    'first_name'  => 'required',
                    'family_name' => 'required',
                    'email'       => 'required|unique:users,email,'.$this->id,
                    'password'    => 'nullable|min:6',
                    'phone'       => 'required',
                    'mobile'      => 'required',
                    'country_id'  => 'required',
                    'city_id'     => 'required',
                ];

                break;
        }


    }
}
