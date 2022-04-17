<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function messages()
    {
        return [
            'first_name.required' => __('first_name_required'),
            'family_name.required' => __('family_name_required'),
            'email.required' => __('email_required'),
            'email.unique' => __('email_unique'),
            'password.min' => __('password_min'),
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
            'first_name' => 'required',
            'family_name' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'address' => 'nullable',
            'second_address' => 'nullable',
            'post_code' => 'nullable',
            'phone' => 'nullable',
            'mobile' => 'nullable',
            'image' => 'nullable',
            'country_id' => 'nullable|exists:countries,id',
            'city_id' => 'nullable|exists:cities,id',
            'password' => 'nullable|min:6',
        ];
    }
}
