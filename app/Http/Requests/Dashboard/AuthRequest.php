<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{

    public function messages()
    {
        return [
            'email.required'    => __('email_required'),
            'email.email'       => __('must_email'),
            'password.required' => __('password_required'),
            'password.min'      => __('password_min'),
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
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ];
    }
}
