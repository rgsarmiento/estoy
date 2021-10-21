<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary">
            <div class="card-body">
                <div class="card-header">
                    <h5>Informacion Basica</h5>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('payroll_type_document_identification_id', 'Tipo Documento<span class="text-danger">(*)</span>')) !!}
                                {!! Form::select('payroll_type_document_identification_id', $tipo_documento->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'select_payroll_type_document_identification_id', 'placeholder' => '-- Seleccionar --']) !!}
                            </div>
                            <div class="invalid-feedback">
                                {{ $errors->first('payroll_type_document_identification_id') }}
                            </div>
                        </div>

                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('identification_number', 'Numero Documento<span class="text-danger">(*)</span>')) !!}
                                {!! Form::number('identification_number', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('identification_number') }}
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('first_name', 'Primer Nombre<span class="text-danger">(*)</span>')) !!}
                                {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('first_name') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group">
                                {!! Form::label('second_name', 'Segundo Nombre') !!}
                                {!! Form::text('second_name', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('second_name') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('surname', 'Primer Apellido<span class="text-danger">(*)</span>')) !!}
                                {!! Form::text('surname', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('surname') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group">
                                {!! Form::label('second_surname', 'Segundo Apellido') !!}
                                {!! Form::text('second_surname', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('second_surname') }}
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('municipality_id', 'Municipio<span class="text-danger">(*)</span>')) !!}
                                {!! Form::select('municipality_id', $municipios->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'select_municipality_id', 'placeholder' => '-- Seleccionar --']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('municipality_id') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-xl-8 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('address', 'Direccion<span class="text-danger">(*)</span>')) !!}
                                {!! Form::text('address', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-4 m-b-30">
                            <div class="form-group">
                                {!! Form::label('telephone', 'Telefono') !!}
                                {!! Form::text('telephone', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('telephone') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('email', 'E-mail<span class="text-danger">(*)</span>')) !!}
                                {!! Form::email('email', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-body">
                <div class="card-header">
                    <h5>Informacion Laboral</h5>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('type_contract_id', 'Tipo Contrato<span class="text-danger">(*)</span>')) !!}
                                {!! Form::select('type_contract_id', $tipo_contrato->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'select_type_contract_id', 'placeholder' => '-- Seleccionar --']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('type_contract_id') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-xl-3 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('admision_date', 'Fecha de Admision<span class="text-danger">(*)</span>')) !!}
                                {!! Form::date('admision_date', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('admision_date') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('type_worker_id', 'Tipo Empleado<span class="text-danger">(*)</span>')) !!}
                                {!! Form::select('type_worker_id', $tipo_empleado->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'select_type_worker_id', 'placeholder' => '-- Seleccionar --']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('type_worker_id') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('sub_type_worker_id', 'Sub Tipo Empleado<span class="text-danger">(*)</span>')) !!}
                                {!! Form::select('sub_type_worker_id', $sub_tipo_empleado->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'select_sub_type_worker_id', 'placeholder' => '-- Seleccionar --']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('sub_type_worker_id') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('payroll_period_id', 'Periodo de Nomina<span class="text-danger">(*)</span>')) !!}
                                {!! Form::select('payroll_period_id', $periodo_nomina->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'select_payroll_period_id', 'placeholder' => '-- Seleccionar --']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('payroll_period_id') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group">
                                {!! Form::checkbox('high_risk_pension', 'value') !!}
                                {!! Form::label('high_risk_pension', 'Pension Alto Riesgo') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('type_salud_law_deduction_id', 'Eps Tipo Deduccion<span class="text-danger">(*)</span>')) !!}
                                {!! Form::select('type_salud_law_deduction_id', $eps_deduccion->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'select_type_salud_law_deduction_id', 'placeholder' => '-- Seleccionar --']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('type_salud_law_deduction_id') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('type_pension_law_deduction_id', 'Pension Tipo Deduccion<span class="text-danger">(*)</span>')) !!}
                                {!! Form::select('type_pension_law_deduction_id', $pension_deduccion->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'select_type_pension_law_deduction_id', 'placeholder' => '-- Seleccionar --']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('type_pension_law_deduction_id') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card card-primary">
            <div class="card-body">
                <div class="card-header">
                    <h5>Informacion Salarial</h5>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-sm-12 col-xl-3 m-b-30">
                            {!! Form::checkbox('integral_salarary', 'value') !!}
                            {!! Form::label('integral_salarary', 'Salario Integral') !!}
                            <br />
                            {!! Form::checkbox('transportation_allowance', 'value') !!}
                            {!! Form::label('transportation_allowance', 'Subsidio de Transporte') !!}
                        </div>

                        <div class="col-sm-12 col-xl-3 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('salary', 'Salario<span class="text-danger">(*)</span>')) !!}
                                {!! Form::number('salary', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('salary') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('payment_method_id', 'Metodo de Pago<span class="text-danger">(*)</span>')) !!}
                                {!! Form::select('payment_method_id', $metodo_pago->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'select_payment_method_id', 'placeholder' => '-- Seleccionar --']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('payment_method_id') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-xl-4 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('account_number', 'Numero de Cuenta<span class="text-danger">(*)</span>')) !!}
                                {!! Form::text('account_number', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('account_number') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-4 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('account_type', 'Tipo Cuenta<span class="text-danger">(*)</span>')) !!}
                                {!! Form::text('account_type', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('account_type') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-4 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('bank_name', 'Banco<span class="text-danger">(*)</span>')) !!}
                                {!! Form::text('bank_name', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('bank_name') }}
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="card-footer">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#select_municipality_id').select2();
            $('#select_payment_method_id').select2();
            $('#select_sub_type_worker_id').select2();
            $('#select_type_worker_id').select2();

        });
    </script>

@endsection
