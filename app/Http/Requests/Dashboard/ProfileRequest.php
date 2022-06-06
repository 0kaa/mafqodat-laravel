<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function messages()
    {
        return [
            'name.required'  => __('name_required'),
            'email.required' => __('email_required'),
            'email.unique'   => __('email_unique'),
            'password.min'   => __('password_min'),
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
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email,' . auth()->user()->id,
            'phone'    => 'nullable',
            'image'    => 'nullable',
            'password' => 'nullable|min:6',
        ];
    }
}
