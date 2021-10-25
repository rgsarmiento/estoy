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
                                {!! Html::decode(Form::label('type_document_identification_id', 'Tipo Documento<span class="text-danger">(*)</span>')) !!}
                                {!! Form::select('type_document_identification_id', $tipo_documento->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'select_type_document_identification_id', 'placeholder' => '-- Seleccionar --']) !!}
                            </div>
                            <div class="invalid-feedback">
                                {{ $errors->first('type_document_identification_id') }}
                            </div>
                        </div>

                        <div class="col-sm-12 col-xl-4 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('identification_number', 'Numero Documento<span class="text-danger">(*)</span>')) !!}
                                {!! Form::number('identification_number', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('identification_number') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-2 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('dv', 'Digito<span class="text-danger">(*)</span>')) !!}
                                {!! Form::number('dv', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('dv') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-xl-12 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('name', 'Nombre<span class="text-danger">(*)</span>')) !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'style' => 'text-transform:uppercase;']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
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
                                {!! Form::label('phone', 'Telefono') !!}
                                {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
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


                    <div class="row">
                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('type_organization_id', 'Tipo Organizacion<span class="text-danger">(*)</span>')) !!}
                                {!! Form::select('type_organization_id', $tipo_organizacion->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'select_type_organization_id', 'placeholder' => '-- Seleccionar --']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('type_organization_id') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('type_regime_id', 'Tipo Regimen<span class="text-danger">(*)</span>')) !!}
                                {!! Form::select('type_regime_id', $tipo_regimen->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'select_type_organization_id', 'placeholder' => '-- Seleccionar --']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('type_regime_id') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('type_liability_id', 'Tipo Responsabilidad<span class="text-danger">(*)</span>')) !!}
                                {!! Form::select('type_liability_id', $tipo_responsabilidad->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'select_type_organization_id', 'placeholder' => '-- Seleccionar --']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('type_liability_id') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('software_id', 'Software Id<span class="text-danger">(*)</span>')) !!}
                                {!! Form::text('software_id', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('software_id') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-4 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('software_pin', 'Software Pin<span class="text-danger">(*)</span>')) !!}
                                {!! Form::number('software_pin', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('software_pin') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('type_environment_id', 'Entorno<span class="text-danger">(*)</span>')) !!}
                                {!! Form::select('type_environment_id', ['1' => '1 Produccion', '2' => '2 Pruebas'], null, ['class' => 'form-control', 'id' => 'select_type_organization_id', 'placeholder' => '-- Seleccionar --']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('type_environment_id') }}
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
</div>

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#select_municipality_id').select2();

        });
    </script>

    @if (Session::has('error'))
        <script>
            Swal.fire("Oops...!", "{{ session()->get('error') }}", "error");
        </script>
    @endif

@endsection
