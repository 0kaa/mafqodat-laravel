<?php

namespace App\Http\Requests\Dashboard;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    public function messages()
    {
        return [
            'name.required'        => __('name_required'),
            'name.min'             => __('name_min'),
            'email.required'       => __('email_required'),
            'email.unique'         => __('email_unique'),
            'password.required'    => __('password_required'),
            'password.min'         => __('password_min'),
            'phone.required'       => __('phone_required'),
            'address.required'     => __('address_required'),
            'address.min'          => __('address_min'),
            'phone.required'       => __('phone_required'),
            'phone.min'            => __('phone_min'),
            'phone.max'            => __('phone_max'),
            'city_id.required'     => __('city_required'),
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
                    'name'           => 'required',
                    'email'          => 'required|unique:users,email,'.$this->id,
                    'password'       => 'nullable|min:6',
                    'phone'          => 'required',
                    'date_of_hiring' => 'required',
                    'job_number'     => 'required',
                    'working_period' => 'required',
                ];

                break;
        }


    }
}
