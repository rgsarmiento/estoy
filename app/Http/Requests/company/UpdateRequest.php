<?php

namespace App\Http\Requests\company;

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
            'type_document_identification_id' => 'required|integer|exists:type_document_identifications,id',
            'identification_number' => 'required|min:7|max:11|unique:workers,identification_number,'.$this->route('company')->id,
            'dv' => 'required|max:1',
            'type_environment_id' => 'required',
            'name' => 'required|min:3|max:50',
            'address' => 'required|min:3|max:200',
            'phone' => 'required|max:20',
            'email' => 'required|email:rfc,dns|unique:companies,email,'.$this->route('company')->id,
            'municipality_id' => 'required|integer|exists:municipalities,id',
            'type_organization_id' => 'required|integer|exists:type_organizations,id',
            'type_regime_id' => 'required|integer|exists:type_regimes,id',
            'type_liability_id' => 'required|integer|exists:type_liabilities,id',

            
                
        ];
    }


    public function messages()
    {
        return [
            'type_document_identification_id.required'=>'El Tipo Documento es requerido.',
            'identification_number.required' => 'El Numero Documento es requrido.',
            'identification_number.min' => 'Minimo 7 caracteres en Numero Documento.',
            'identification_number.max' => 'Maximo 11 caracteres en Numero Documento.',
            'identification_number.unique' => 'El Numero Documento ya existe con otra Empresa.',
            'name.required' => 'El Nombre es requerido.',
            'name.min' => 'Minimo 3 caracteres en Nombre.',
            'name.max' => 'Maximo 50 caracteres en Nombre.',
            'address.required' => 'La Direccion es requerida.',
            'address.min' => 'Minimo 3 caracteres en la Direccion.',
            'address.max' => 'Maximo 200 caracteres en la Direccion.',
            'phone.max' => 'Maximo 20 caracteres en el Telefono.',
            'email.required' => 'El E-mail es requerido.',
            'email.email' => 'El formato del E-mail no es valido.',
            'email.unique' => 'El E-mail ya existe con otra Empresa.',
            'municipality_id.required' => 'El Municipio es requerido.',
            'type_organization_id.required' => 'El Tipo Organizacion es requerido.',
            'type_regime_id.required' => 'El Tipo Regimen es requerido.',
            'type_liability_id.required' => 'El Tipo Responsabilidad es requerido.',
            ];
    }

}
