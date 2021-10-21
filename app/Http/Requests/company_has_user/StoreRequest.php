<?php

namespace App\Http\Requests\company_has_user;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'company_id' => 'required|integer',
            'user_id' => 'required|integer|unique:company_has_users',            
        ];
    }

    public function messages()
    {
        return [
            'company_id.required'=>'La Empresa es requerida.',
            'user_id.unique' => 'El Usuario ya se relaciono con otra Empresa.',
            'user_id.required' => 'El Usuario es requerido.',
            
            ];
    }
}
