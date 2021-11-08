<?php

namespace App\Http\Requests\payroll;

use Illuminate\Foundation\Http\FormRequest;

class SendRequest extends FormRequest
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
            'periodo_ni' => 'required',
            'fecha_pago_ni' => 'required'            
        ];
    }

    public function messages()
    {
        return [

            'periodo_ni.required' => 'Se requiere que se seleccione un periodo',
            'fecha_pago_ni.required' => 'Se requiere una fecha de pago' 

            ];
    }

}
