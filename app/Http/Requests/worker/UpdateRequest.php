<?php

namespace App\Http\Requests\worker;

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
                'payroll_type_document_identification_id' => 'required',
                'identification_number' => 'required|unique:workers,identification_number,'. $this->route('worker')->id.'|min:8|max:11',
                'surname' => 'required|min:3|max:50',
                'second_surname' => 'max:50',
                'first_name' => 'required|min:3|max:50',
                'second_name' => 'max:50',
                'address' => 'required|min:3|max:200',
                'telephone' => 'max:20',
                'email' => 'required|email:rfc,dns|unique:workers,email,'. $this->route('worker')->id,
                'municipality_id' => 'required',
                 //Informacion laboral
                'type_contract_id' => 'required',
                'admision_date' => 'required',
                'type_worker_id' => 'required',
                'sub_type_worker_id' => 'required',
                'payroll_period_id' => 'required',
                'high_risk_pension',
                'type_salud_law_deduction_id' => 'required',
                'type_pension_law_deduction_id' => 'required',
                //informacion salarial
                'integral_salarary',
                'salary' => 'required',
                'transportation_allowance',
                'payment_method_id' => 'required',
                'bank_name' => 'max:100',
                'account_type' => 'max:50',
                'account_number' => 'max:50',
        ];
    }

    public function messages()
    {
        return [
            'payroll_type_document_identification_id.required'=>'El Tipo Documento es requerido.',
            'identification_number.required' => 'El Numero Documento es requrido.',
            'identification_number.min' => 'Minimo 8 caracteres en Numero Documento.',
            'identification_number.max' => 'Maximo 11 caracteres en Numero Documento.',
            'identification_number.unique' => 'El Numero Documento ya existe con otro Empleado.',
            'first_name.required' => 'El Primer Nombre es requerido.',
            'first_name.min' => 'Minimo 3 caracteres en Primer Nombre.',
            'first_name.max' => 'Maximo 50 caracteres en Primer Nombre.',
            'second_name.max' => 'Maximo 50 caracteres en Segundo Nombre.',
            'surname.required' => 'El Primer Apellido es requerido.',
            'surname.min' => 'Minimo 3 caracteres en Primer Apellido.',
            'surname.max' => 'Maximo 50 caracteres en Primer Apellido.',
            'second_surname.max' => 'Maximo 50 caracteres en Segundo Apellido.',
            'address.required' => 'La Direccion es requerida.',
            'address.min' => 'Minimo 3 caracteres en la Direccion.',
            'address.max' => 'Maximo 200 caracteres en la Direccion.',
            'telephone.max' => 'Maximo 20 caracteres en el Telefono.',
            'email.required' => 'El E-mail es requerido.',
            'email.email' => 'El formato del E-mail no es valido.',
            'email.unique' => 'El E-mail ya existe con otro Empleado.',
            'municipality_id.required' => 'El Municipio es requerido.',
             //Informacion laboral
            'type_contract_id.required' => 'El Tipo Contrato es requerido.',
            'admision_date.required' => 'La Fecha de Admision es requerida.',
            'type_worker_id.required' => 'El Tipo Empleado es requerido.',
            'sub_type_worker_id.required' => 'El Sub Tipo Empleado es requerido.',
            'payroll_period_id.required' => 'El Periodo de Nomina es requerido.',
            'type_salud_law_deduction_id.required' => 'Eps Tipo Deduccion es requerido.',
            'type_pension_law_deduction_id.required' => 'Pension Tipo Deduccion es requerido.',
            //informacion salarial
            'salary.required' => 'El Salario es requerido.',
            'payment_method_id.required' => 'El Metodo de Pago es requerido.',
            'bank_name.max' => 'Maximo 100 caracteres en Banco.',
            'account_type.max' => 'Maximo 50 caracteres en Tipo Cuenta.',
            'account_number.max' => 'Maximo 50 caracteres en Numero de Cuenta.',
        ];
    }
}
