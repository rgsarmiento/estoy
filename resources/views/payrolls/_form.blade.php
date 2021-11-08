<div class="row mt-sm-4">
    <div class="col-12 col-md-12 col-lg-5">
        <div class="card profile-widget">
            <div class="profile-widget-header">
                <img alt="image" src="{{ asset('img/avatar/yo-1.png') }}"
                    class="rounded-circle profile-widget-picture">
                <div class="profile-widget-items">

                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label"><i class="fas fa-book-reader mr-1"></i> Tipo Contrato</div>
                        <div class="profile-widget-item-value">{{ $payroll->worker->type_contract->name }}</div>
                    </div>

                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label"><i class="fas fa-dollar-sign mr-1"></i> Salario</div>
                        <div class="profile-widget-item-value">{{ number_format($payroll->worker->salary, 2) }}</div>
                        <input type="hidden" id="salary" value="{{ $payroll->worker->salary }}">
                    </div>

                </div>
            </div>
            <div class="profile-widget-description">

                <strong><i class="fas fa-id-card mr-1"></i>
                    {{ $payroll->worker->payroll_type_document_identification->name }}</strong>
                <p class="text-muted">
                    {{ $payroll->worker->identification_number }}
                </p>
                <strong><i class="fas fa-street-view mr-1"></i> Nombre</strong>
                <p class="text-muted">
                    <a
                        href="{{ route('workers.show', $payroll->worker) }}">{{ $payroll->worker->first_name . ' ' . $payroll->worker->surname }}</a>

                </p>
                <strong><i class="fas fa-map-marked-alt mr-1"></i> Direccion</strong>
                <p class="text-muted">
                    {{ $payroll->worker->address . ' (' . $payroll->worker->municipality->name . '-' . $payroll->worker->municipality->department->name . ')' }}
                </p>
                <strong><i class="fas fa-mobile-alt mr-1"></i> Telefono</strong>
                <p class="text-muted">
                    {{ $payroll->worker->telephone }}
                </p>
                <strong><i class="fas fa-envelope mr-1"></i> E-mail</strong>
                <p class="text-muted">
                    {{ $payroll->worker->email }}
                </p>


                <div class="card-header">
                    <h4>Informacion Laboral</h4>
                </div>


                <strong><i class="fas fa-calendar-alt mr-1"></i> Fecha Admision</strong>
                <p class="text-muted">
                    {{ $payroll->worker->admision_date }}
                </p>
                <strong><i class="fas fa-bookmark mr-1"></i> Tipo y Sub Tipo Empleado</strong>
                <p class="text-muted">
                    {{ $payroll->worker->type_worker->name . ' - ' . $payroll->worker->sub_type_worker->name }}
                </p>
                <strong><i class="fas fa-calendar-day mr-1"></i> Periodo Nomina</strong>
                <p class="text-muted">
                    {{ $payroll->worker->payroll_period->name }}
                </p>
                <strong><i class="fas fa-blind mr-1"></i> Pension de alto Riesgo</strong>
                <p class="text-muted">
                    @if ($payroll->worker->high_risk_pension == 1)
                        SI
                    @else
                        NO
                    @endif
                </p>

                <div class="card-header">
                    <h4>Informacion Salarial</h4>
                </div>

                <strong><i class="fas fa-hand-holding-usd mr-1"></i> Salario Integral</strong>
                <p class="text-muted">
                    @if ($payroll->worker->integral_salarary == 1)
                        SI
                    @else
                        NO
                    @endif
                </p>
                <strong><i class="fas fa-bus mr-1"></i> Subsidio de Transporte</strong>
                <p class="text-muted">
                    @if ($payroll->worker->transportation_allowance == 1)
                        SI
                        <input type="hidden" id="transportation_allowance" value="SI">
                    @else
                        NO
                        <input type="hidden" id="transportation_allowance" value="NO">
                    @endif
                </p>
                <strong><i class="fas fa-wallet mr-1"></i> Metodo de Pago</strong>
                <p class="text-muted">
                    {{ $payroll->worker->payment_method->name }}
                </p>
                <strong><i class="fas fa-university mr-1"></i> Banco</strong>
                <p class="text-muted">
                    {{ $payroll->worker->bank_name }}
                </p>
                <strong><i class="fas fa-file-invoice mr-1"></i> Tipo Cuenta</strong>
                <p class="text-muted">
                    {{ $payroll->worker->account_type }}
                </p>
                <strong><i class="fas fa-hashtag mr-1"></i> Numero Cuenta</strong>
                <p class="text-muted">
                    {{ $payroll->worker->account_number }}
                </p>


            </div>

        </div>
    </div>



    <div class="col-12 col-md-12 col-lg-7">

        <div class="card profile-widget">
            <div class="profile-widget-header">
                <div class="profile-widget-items">

                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label">
                            <i class="fas fa-cloud-sun mr-1"></i> Dias Trabajados
                        </div>

                        <div class="input-group col-md-12 col-12">
                            {!! Form::number('worked_days', null, ['class' => 'form-control', 'id' => 'worked_days']) !!}
                            <div class="input-group-append">
                                <button id="btn_recalcular" class="btn btn-primary" type="button">Recalcular</button>
                            </div>
                        </div>

                    </div>

                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label"><i class="fas fa-dollar-sign mr-1"></i> Total Pago</div>
                        <div id="payroll_total2" class="profile-widget-item-value">
                            {{ number_format($payroll->payroll_total, 2) }}</div>
                    </div>

                </div>
            </div>
        </div>




        <div class="card">
            <div class="card-header">
                <h4>DEVENGADOS</h4>
            </div>
            <div class="card-body">

                <div class="form-group">
                    {!! Html::decode(Form::label('tipo_devengado', 'Tipo Devengado')) !!}
                    {!! Form::select('tipo_devengado', $type_accrueds->pluck('name', 'node'), null, ['class' => 'form-control', 'id' => 'select_tipo_devengado', 'placeholder' => '-- Seleccionar --']) !!}
                </div>

                <div class="row" id="div_rango_fecha_a">
                    <div class="col-sm-12 col-xl-6 m-b-30">
                        <div class="form-group">
                            <label>Fecha Inicio</label>
                            <input type="date" class="form-control" id="start_date_a">
                        </div>
                    </div>

                    <div class="col-sm-12 col-xl-6 m-b-30">
                        <div class="form-group">
                            <label>Fecha Fin</label>
                            <input type="date" class="form-control" id="end_date_a">
                        </div>
                    </div>
                </div>

                <div class="row" id="div_quantity_a">
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label>Cantidad de Dias</label>
                            <input type="number" class="form-control" id="quantity_a">
                        </div>
                    </div>
                </div>

                <div class="row" id="div_accrued_value">
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label>Valor Pagado</label>
                            <input type="number" class="form-control" id="val_accrued">
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12" id="div_add_accrueds">
                    <button type="button" class="btn btn-info" id="add_accrued">Add. pago</button>
                </div>

                <br>
                <div id="alert_accrued">
                    <div class="col-md-12 col-12">
                    </div>
                </div>



                <table id="tbl_accrueds" class="table table-bordered table-hover border-primary table-striped mt-2">

                    <tbody>
                        @php
                            $devengados_json = json_decode($payroll->accrued, true);
                            
                            $salary = $devengados_json['devengados']['salary'];
                            $transportation_allowance = $devengados_json['devengados']['transportation_allowance'];
                            
                            $common_vacation = $devengados_json['devengados']['common_vacation'];
                            $paid_vacation = $devengados_json['devengados']['paid_vacation'];
                            $maternity_leave = $devengados_json['devengados']['maternity_leave'];
                            $paid_leave = $devengados_json['devengados']['paid_leave'];
                            $legal_strike = $devengados_json['devengados']['legal_strike'];
                            
                        @endphp

                        <tr id="salario1">
                            <td>{!! $salary['name'] !!}</td>
                            <td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i>
                                ${!! number_format($salary['value'], 2) !!}</td>
                            <td><a href="" class="btn disabled btn-icon btn-sm btn-danger"><i
                                        class="fas fa-times"></i></a></td>
                        </tr>

                        @if (count($transportation_allowance))
                            <tr id="aux_transporte1">
                                <td>{!! $transportation_allowance['name'] !!}</td>
                                <td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i>
                                    ${!! number_format($transportation_allowance['value'], 2) !!}</td>
                                <td><a href="" class="btn disabled btn-icon btn-sm btn-danger"><i
                                            class="fas fa-times"></i></a></td>
                            </tr>
                        @endif

                        @foreach ($common_vacation as $value)
                            <tr id="common_vacation-{!! $value['id'] !!}">
                                <td>{!! $value['name'] !!} Fecha: ({!! $value['start_date'] !!} / {!! $value['end_date'] !!}) Dias: {!! $value['quantity'] !!}</td>
                                <td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i>
                                    ${!! number_format($value['payment'], 2) !!}</td>
                                <td><a href="javascript:eliminar_accrued({!! $value['id'] !!},'common_vacation', {!! $value['payment'] !!})"
                                        class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td>
                            </tr>
                        @endforeach

                        @foreach ($paid_vacation as $value)
                        <tr id="paid_vacation-{!! $value['id'] !!}">
                            <td>{!! $value['name'] !!} Fecha: ({!! $value['start_date'] !!} / {!! $value['end_date'] !!}) Dias: {!! $value['quantity'] !!}</td>
                            <td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i>
                                ${!! number_format($value['payment'], 2) !!}</td>
                            <td><a href="javascript:eliminar_accrued({!! $value['id'] !!},'paid_vacation', {!! $value['payment'] !!})"
                                    class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td>
                        </tr>
                    @endforeach

                    @foreach ($maternity_leave as $value)
                        <tr id="maternity_leave-{!! $value['id'] !!}">
                            <td>{!! $value['name'] !!} Fecha: ({!! $value['start_date'] !!} / {!! $value['end_date'] !!}) Dias: {!! $value['quantity'] !!}</td>
                            <td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i>
                                ${!! number_format($value['payment'], 2) !!}</td>
                            <td><a href="javascript:eliminar_accrued({!! $value['id'] !!},'maternity_leave', {!! $value['payment'] !!})"
                                    class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td>
                        </tr>
                    @endforeach

                    @foreach ($paid_leave as $value)
                        <tr id="paid_leave-{!! $value['id'] !!}">
                            <td>{!! $value['name'] !!} Fecha: ({!! $value['start_date'] !!} / {!! $value['end_date'] !!}) Dias: {!! $value['quantity'] !!}</td>
                            <td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i>
                                ${!! number_format($value['payment'], 2) !!}</td>
                            <td><a href="javascript:eliminar_accrued({!! $value['id'] !!},'paid_leave', {!! $value['payment'] !!})"
                                    class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td>
                        </tr>
                    @endforeach

                    @foreach ($legal_strike as $value)
                        <tr id="legal_strike-{!! $value['id'] !!}">
                            <td>{!! $value['name'] !!} Fecha: ({!! $value['start_date'] !!} / {!! $value['end_date'] !!}) Dias: {!! $value['quantity'] !!}</td>
                            <td align="right"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i>
                                ${!! number_format($value['payment'], 2) !!}</td>
                            <td><a href="javascript:eliminar_accrued({!! $value['id'] !!},'legal_strike', {!! $value['payment'] !!})"
                                    class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td>
                        </tr>
                    @endforeach



                    </tbody>
                    <tfoot style="background-color: #b5eee0;">
                        <tr align="center">
                            <th>TOTAL</th>
                            <th colspan="2"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i>
                                ${!! number_format($payroll->accrued_total, 2) !!}</th>
                        </tr>
                    </tfoot>
                </table>
                {!! Form::hidden('accrued', null, ['class' => 'form-control', 'id' => 'accrued']) !!}
                {!! Form::hidden('accrued_total', null, ['class' => 'form-control', 'id' => 'accrued_total']) !!}

                <input type="hidden" id="transportation_allowance_value"
                    value={{ $configuraciones->transport_allowance }}>

            </div>

        </div>


        <div class="card">
            <div class="card-header">
                <h4>DEDUCIDOS</h4>
            </div>
            <div class="card-body">


                <div class="form-group">
                    {!! Html::decode(Form::label('tipo_deduccion', 'Tipo Deducción')) !!}
                    {!! Form::select('tipo_deduccion', $type_deductions->pluck('name', 'node'), null, ['class' => 'form-control', 'id' => 'select_tipo_deduccion', 'placeholder' => '-- Seleccionar --']) !!}

                </div>


                <div class="row" id="div_deduction_value">
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label>Valor Deducción</label>
                            <input type="number" class="form-control" id="val_deduction">
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12" id="div_add_deductions">
                    <button type="button" class="btn btn-info" id="add_deductions">Add. Deduccion</button>
                </div>


                <br>
                <div id="alert_deductions">
                    <div class="col-md-12 col-12">
                    </div>
                </div>

                <table id="tbl_deductions" class="table table-bordered table-hover border-primary table-striped mt-2">

                    <tbody>

                        @php
                            $deducciones_json = json_decode($payroll->deductions, true);
                            
                            $eps_type_law_deduction = $deducciones_json['deducciones']['eps_type_law_deduction'];
                            $pension_type_law_deductions = $deducciones_json['deducciones']['pension_type_law_deductions'];
                            $other_deductions = $deducciones_json['deducciones']['other_deductions'];
                            
                        @endphp

                        <tr id="eps1">
                            <td>{!! $eps_type_law_deduction['name'] !!}</td>
                            <td align="right"><i class="fa fa-sort-down" style="font-size:18px;color:#FF267B;"></i>
                                ${!! number_format($eps_type_law_deduction['value'], 2) !!}</td>
                            <td><a href="" class="btn disabled btn-icon btn-sm btn-danger"><i
                                        class="fas fa-times"></i></a></td>

                        </tr>

                        <tr id="pension1">
                            <td>{!! $pension_type_law_deductions['name'] !!}</td>
                            <td align="right"><i class="fa fa-sort-down" style="font-size:18px;color:#FF267B;"></i>
                                ${!! number_format($pension_type_law_deductions['value'], 2) !!}</td>
                            <td><a href="" class="btn disabled btn-icon btn-sm btn-danger"><i
                                        class="fas fa-times"></i></a></td>

                        </tr>


                        @foreach ($other_deductions as $value)
                            <tr id="other_deductions-{!! $value['id'] !!}">
                                <td>{!! $value['name'] !!}</td>
                                <td align="right"><i class="fa fa-sort-down" style="font-size:18px;color:#FF267B;"></i>
                                    ${!! number_format($value['value'], 2) !!}</td>
                                <td><a href="javascript:eliminar_deduccion({!! $value['id'] !!}, 'other_deductions', {!! $value['value'] !!})"
                                        class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a></td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot style="background-color: #f8cfcc;">
                        <tr align="center">
                            <th>TOTAL</th>
                            <th colspan="2"><i class="fa fa-sort-down" style="font-size:20px;color:#FF267B;"></i>
                                ${!! number_format($payroll->deductions_total, 2) !!}</th>
                        </tr>
                    </tfoot>
                </table>
                {{--  --}}
                {!! Form::hidden('deductions', null, ['class' => 'form-control', 'id' => 'deductions']) !!}
                {!! Form::hidden('deductions_total', null, ['class' => 'form-control', 'id' => 'deductions_total']) !!}

                {!! Form::hidden('payroll_total', null, ['class' => 'form-control', 'id' => 'payroll_total']) !!}

            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <h4>GUARDAR CAMBIOS</h4>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="form-group col-12">
                        <label>Notas</label>
                        {!! Form::textarea('notes', null, ['class' => 'form-control summernote-simple', 'id' => 'notes']) !!}

                    </div>
                </div>

            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </div>



    </div>
</div>
