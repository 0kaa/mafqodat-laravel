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
            'details'         => 'required',
            'category_id'     => 'required',
            'station_id'      => 'required',
            'storage'         => 'required',
            'date'            => 'required',
            'description'     => 'sometimes',
            'image'           => 'sometimes',
            'location'        => 'required',
        ];
    }
}
