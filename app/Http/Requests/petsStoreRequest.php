<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class petsStoreRequest extends FormRequest
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
            'unique_code' => 'required|unique:pets',
            'nickname' => 'required|max:20',
            'species' => 'required|in:Canino,Felino',
            'age' => 'required|max:3'
        ];
    }
}
