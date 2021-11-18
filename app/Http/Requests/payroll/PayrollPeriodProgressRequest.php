<?php

namespace App\Http\Requests\payroll;

use Illuminate\Foundation\Http\FormRequest;

class PayrollPeriodProgressRequest extends FormRequest
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
            'payroll_period_id' => 'required',
            'payment_date' => 'required'            
        ];
    }

    public function messages()
    {
        return [
            'payroll_period_id.required' => 'Se requiere que se seleccione un periodo',
            'payment_date.required' => 'Se requiere una fecha de pago' 
            ];
    }

}
