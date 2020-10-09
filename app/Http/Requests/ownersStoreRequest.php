<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ownersStoreRequest extends FormRequest
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
            'dpi' => 'required|max:13|unique:owners',
            'owner_name' => 'required|max:30',
            'owner_lastname' => 'required|max:30',
            'telephone' => 'required|max:8',
            'e_mail_address' => 'required|email|max:40|unique:owners'

        ];
    }
}
