<?php

namespace App\Http\Requests\payroll;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'worked_days' => 'required|integer|gt:0|lt:31',
            'accrued' => 'required',
            'accrued_total' => 'required',
            'deductions' => 'required',
            'deductions_total' => 'required',
            'payroll_total' => 'required' 
        ];
    }


    public function messages()
    {
        return [

            'worked_days.required' => 'Se requiere un numero de días trabajados',
            'worked_days.gt' => 'El numero de días trabajados debe ser mayor o igual a 1',
            'worked_days.lt' => 'El numero de días trabajados debe ser menor o igual a 30',
            'accrued.required' => 'Se requiere una lista de Devengados',
            'accrued_total.required' => 'Se requiere un total en Devengados',
            'deductions.required' => 'Se requiere una lista de Deducciones',
            'deductions_total.required' => 'Se requiere un total en Deducciones',
            'payroll_total.required' => 'Se requiere un total a pagar' 

            ];
    }

}
