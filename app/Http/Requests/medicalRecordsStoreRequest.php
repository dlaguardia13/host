<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class medicalRecordsStoreRequest extends FormRequest
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
            'pet' => 'required',
            'owner' => 'required',
            'consultation_date' => 'required',
            'actual_weight' => 'required|max:3',
            'reason' => 'required',
            'description' => 'required'
        ];
    }
}
