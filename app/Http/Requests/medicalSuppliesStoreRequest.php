<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class medicalSuppliesStoreRequest extends FormRequest
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
            'serial' => 'required|max:13',
            'supply_name' => 'required|max:20',
            'brand' => 'required|max:20',
            'presentation' => 'required|max:8',
            'stock' => 'required|max:3'
        ];
    }
}
