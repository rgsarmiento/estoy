<div class="row mt-sm-4">
    <div class="col-12 col-md-12 col-lg-5">
        <div class="card profile-widget">
            <div class="profile-widget-header">
                <img alt="image" src="{{ asset('img/avatar/yo-1.png') }}"
                    class="rounded-circle profile-widget-picture">
                <div class="profile-widget-items">

                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label"><i class="fas fa-book-reader mr-1"></i> Tipo Contrato</div>
                        <div class="profile-widget-item-value">{{ $document->worker->type_contract->name }}</div>
                    </div>

                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label"><i class="fas fa-dollar-sign mr-1"></i> Salario</div>
                        <div class="profile-widget-item-value">{{ number_format($document->worker->salary, 2) }}</div>
                        <input type="hidden" id="salary" value="{{ $document->worker->salary }}">
                    </div>

                </div>
            </div>
            <div class="profile-widget-description">

                <strong><i class="fas fa-id-card mr-1"></i>
                    {{ $document->worker->payroll_type_document_identification->name }}</strong>
                <p class="text-muted">
                    {{ $document->worker->identification_number }}
                </p>
                <strong><i class="fas fa-street-view mr-1"></i> Nombre</strong>
                <p class="text-muted">
                    <a
                        href="{{ route('workers.show', $document->worker) }}">{{ $document->worker->first_name . ' ' . $document->worker->surname }}</a>

                </p>
                <strong><i class="fas fa-map-marked-alt mr-1"></i> Direccion</strong>
                <p class="text-muted">
                    {{ $document->worker->address . ' (' . $document->worker->municipality->name . '-' . $document->worker->municipality->department->name . ')' }}
                </p>
                <strong><i class="fas fa-mobile-alt mr-1"></i> Telefono</strong>
                <p class="text-muted">
                    {{ $document->worker->telephone }}
                </p>
                <strong><i class="fas fa-envelope mr-1"></i> E-mail</strong>
                <p class="text-muted">
                    {{ $document->worker->email }}
                </p>


                <div class="card-header">
                    <h4>Informacion Laboral</h4>
                </div>


                <strong><i class="fas fa-calendar-alt mr-1"></i> Fecha Admision</strong>
                <p class="text-muted">
                    {{ $document->worker->admision_date }}
                </p>
                <strong><i class="fas fa-bookmark mr-1"></i> Tipo y Sub Tipo Empleado</strong>
                <p class="text-muted">
                    {{ $document->worker->type_worker->name . ' - ' . $document->worker->sub_type_worker->name }}  
                </p>
                    <input id="type_worker_id" type="hidden"
                    value="{{ $document->worker->type_worker->id }}">
                <strong><i class="fas fa-calendar-day mr-1"></i> Periodo Nomina</strong>
                <p class="text-muted">
                    {{ $document->worker->payroll_period->name }}
                </p>
                <strong><i class="fas fa-blind mr-1"></i> Pension de alto Riesgo</strong>
                <p class="text-muted">
                    @if ($document->worker->high_risk_pension == 1)
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
                    @if ($document->worker->integral_salarary == 1)
                        SI
                    @else
                        NO
                    @endif
                </p>
                <strong><i class="fas fa-bus mr-1"></i> Subsidio de Transporte</strong>
                <p class="text-muted">
                    @if ($document->worker->transportation_allowance == 1)
                        SI
                        <input type="hidden" id="transportation_allowance" value="SI">
                    @else
                        NO
                        <input type="hidden" id="transportation_allowance" value="NO">
                    @endif
                </p>
                <strong><i class="fas fa-wallet mr-1"></i> Metodo de Pago</strong>
                <p class="text-muted">
                    {{ $document->worker->payment_method->name }}
                </p>
                <strong><i class="fas fa-university mr-1"></i> Banco</strong>
                <p class="text-muted">
                    {{ $document->worker->bank_name }}
                </p>
                <strong><i class="fas fa-file-invoice mr-1"></i> Tipo Cuenta</strong>
                <p class="text-muted">
                    {{ $document->worker->account_type }}
                </p>
                <strong><i class="fas fa-hashtag mr-1"></i> Numero Cuenta</strong>
                <p class="text-muted">
                    {{ $document->worker->account_number }}
                </p>


            </div>

        </div>
    </div>



    <div class="col-12 col-md-12 col-lg-7">


        <div class="card profile-widget">
            <div class="profile-widget-header">
                <div class="profile-widget-items">
                    <div class="profile-widget-item">

                        <strong>Documento</strong>
                        <p class="text-muted">
                            {{ $document->prefix. ' - ' . $document->consecutive }}
                        </p>

                        <strong>Cune</strong>
                        <p class="text-muted" style="font-size:8px;">
                            {{ $document->cune }}
                        </p>

                    </div>
                </div>
            </div>
        </div>



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
                            {{ number_format($document->payroll_total, 2) }}</div>
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

                <div class="row" id="div_rango_fecha_h_a">
                    <div class="col-sm-12 col-xl-6 m-b-30">
                        <div class="form-group">
                            <label>Hora Inicio</label>
                            <input type="datetime-local" class="form-control" id="start_date_h_a">
                        </div>
                    </div>

                    <div class="col-sm-12 col-xl-6 m-b-30">
                        <div class="form-group">
                            <label>Hora Fin</label>
                            <input type="datetime-local" class="form-control" id="end_date_h_a">
                        </div>
                    </div>
                </div>

                {{-- solo para incapacidades --}}
                <div class="row" id="div_type_incapacidad_a">
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label>Tipo Incapacidad</label>
                            <select class="form-control" id="type_incapacidad_a">
                                <option value=1>Común</option>
                                <option value=2>Profesional</option>
                                <option value=3>Laboral</option>
                            </select>
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

                <div class="row" id="div_quantity_h_a">
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label>Cantidad de Horas</label>
                            <input type="number" class="form-control" id="quantity_h_a">
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

                <div class="row" id="div_accrued_intereses">
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label>% Intereses</label>
                            <input type="number" class="form-control" id="val_accrued_pocentaje_intereses">
                        </div>
                        <div class="form-group">
                            <label>Valor Intereses</label>
                            <input type="number" class="form-control" id="val_accrued_value_intereses">
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12" id="div_add_accrueds">
                    <button type="button" class="btn btn-success" id="add_accrued">Agregar</button>
                </div>

                <br>
                <div id="alert_accrued">
                    <div class="col-md-12 col-12">
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="tbl_accrueds"
                        class="table table-bordered table-hover border-primary table-striped mt-2">

                        <tbody>
                            @php
                                $devengados_json = json_decode($document->accrued, true);
                                
                                $salary = $devengados_json['devengados']['salary'];
                                $transportation_allowance = $devengados_json['devengados']['transportation_allowance'];
                                
                                $common_vacation = $devengados_json['devengados']['common_vacation'];
                                $paid_vacation = $devengados_json['devengados']['paid_vacation'];
                                $maternity_leave = $devengados_json['devengados']['maternity_leave'];
                                $paid_leave = $devengados_json['devengados']['paid_leave'];
                                $legal_strike = $devengados_json['devengados']['legal_strike'];
                                
                                $HEDs = $devengados_json['devengados']['HEDs'];
                                $HENs = $devengados_json['devengados']['HENs'];
                                $HRNs = $devengados_json['devengados']['HRNs'];
                                $HEDDFs = $devengados_json['devengados']['HEDDFs'];
                                $HRDDFs = $devengados_json['devengados']['HRDDFs'];
                                $HENDFs = $devengados_json['devengados']['HENDFs'];
                                $HRNDFs = $devengados_json['devengados']['HRNDFs'];
                                
                                $work_disabilities = $devengados_json['devengados']['work_disabilities'];
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
                                    <td align="right"><i class="fa fa-sort-up"
                                            style="font-size:18px;color:#00D0C4;"></i>
                                        ${!! number_format($transportation_allowance['value'], 2) !!}</td>
                                    <td><a href="" class="btn disabled btn-icon btn-sm btn-danger"><i
                                                class="fas fa-times"></i></a></td>
                                </tr>
                            @endif

                            @foreach ($common_vacation as $value)
                                <tr id="common_vacation-{!! $value['id'] !!}">
                                    <td>PAGO DE {!! $value['quantity'] !!} DIA(S) DE {!! $value['name'] !!} DESDE
                                        {!! $value['start_date'] !!} HASTA {!! $value['end_date'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-up"
                                            style="font-size:18px;color:#00D0C4;"></i>
                                        ${!! number_format($value['payment'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_accrued({!! $value['id'] !!},'common_vacation', {!! $value['payment'] !!})"
                                            class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            @foreach ($paid_vacation as $value)
                                <tr id="paid_vacation-{!! $value['id'] !!}">
                                    <td>PAGO DE {!! $value['quantity'] !!} DIA(S) DE {!! $value['name'] !!} DESDE
                                        {!! $value['start_date'] !!} HASTA {!! $value['end_date'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-up"
                                            style="font-size:18px;color:#00D0C4;"></i>
                                        ${!! number_format($value['payment'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_accrued({!! $value['id'] !!},'paid_vacation', {!! $value['payment'] !!})"
                                            class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            @foreach ($maternity_leave as $value)
                                <tr id="maternity_leave-{!! $value['id'] !!}">
                                    <td>PAGO DE {!! $value['quantity'] !!} DIA(S) DE {!! $value['name'] !!} DESDE
                                        {!! $value['start_date'] !!} HASTA {!! $value['end_date'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-up"
                                            style="font-size:18px;color:#00D0C4;"></i>
                                        ${!! number_format($value['payment'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_accrued({!! $value['id'] !!},'maternity_leave', {!! $value['payment'] !!})"
                                            class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            @foreach ($paid_leave as $value)
                                <tr id="paid_leave-{!! $value['id'] !!}">
                                    <td>PAGO DE {!! $value['quantity'] !!} DIA(S) DE {!! $value['name'] !!} DESDE
                                        {!! $value['start_date'] !!} HASTA {!! $value['end_date'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-up"
                                            style="font-size:18px;color:#00D0C4;"></i>
                                        ${!! number_format($value['payment'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_accrued({!! $value['id'] !!},'paid_leave', {!! $value['payment'] !!})"
                                            class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            @foreach ($legal_strike as $value)
                                <tr id="legal_strike-{!! $value['id'] !!}">
                                    <td>PAGO DE {!! $value['quantity'] !!} DIA(S) DE {!! $value['name'] !!} DESDE
                                        {!! $value['start_date'] !!} HASTA {!! $value['end_date'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-up"
                                            style="font-size:18px;color:#00D0C4;"></i>
                                        ${!! number_format($value['payment'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_accrued({!! $value['id'] !!},'legal_strike', {!! $value['payment'] !!})"
                                            class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            @foreach ($HEDs as $value)
                                <tr id="HEDs-{!! $value['id'] !!}">
                                    <td>PAGO DE {!! $value['quantity'] !!} {!! $value['name'] !!} DESDE
                                        {!! $value['start_time'] !!} HASTA {!! $value['end_time'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-up"
                                            style="font-size:18px;color:#00D0C4;"></i>
                                        ${!! number_format($value['payment'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_accrued({!! $value['id'] !!},'HEDs', {!! $value['payment'] !!})"
                                            class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            @foreach ($HENs as $value)
                                <tr id="HENs-{!! $value['id'] !!}">
                                    <td>PAGO DE {!! $value['quantity'] !!} {!! $value['name'] !!} DESDE
                                        {!! $value['start_time'] !!} HASTA {!! $value['end_time'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-up"
                                            style="font-size:18px;color:#00D0C4;"></i>
                                        ${!! number_format($value['payment'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_accrued({!! $value['id'] !!},'HENs', {!! $value['payment'] !!})"
                                            class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            @foreach ($HRNs as $value)
                                <tr id="HRNs-{!! $value['id'] !!}">
                                    <td>PAGO DE {!! $value['quantity'] !!} {!! $value['name'] !!} DESDE
                                        {!! $value['start_time'] !!} HASTA {!! $value['end_time'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-up"
                                            style="font-size:18px;color:#00D0C4;"></i>
                                        ${!! number_format($value['payment'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_accrued({!! $value['id'] !!},'HRNs', {!! $value['payment'] !!})"
                                            class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            @foreach ($HEDDFs as $value)
                                <tr id="HEDDFs-{!! $value['id'] !!}">
                                    <td>PAGO DE {!! $value['quantity'] !!} {!! $value['name'] !!} DESDE
                                        {!! $value['start_time'] !!} HASTA {!! $value['end_time'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-up"
                                            style="font-size:18px;color:#00D0C4;"></i>
                                        ${!! number_format($value['payment'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_accrued({!! $value['id'] !!},'HEDDFs', {!! $value['payment'] !!})"
                                            class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            @foreach ($HRDDFs as $value)
                                <tr id="HRDDFs-{!! $value['id'] !!}">
                                    <td>PAGO DE {!! $value['quantity'] !!} {!! $value['name'] !!} DESDE
                                        {!! $value['start_time'] !!} HASTA {!! $value['end_time'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-up"
                                            style="font-size:18px;color:#00D0C4;"></i>
                                        ${!! number_format($value['payment'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_accrued({!! $value['id'] !!},'HRDDFs', {!! $value['payment'] !!})"
                                            class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            @foreach ($HENDFs as $value)
                                <tr id="HENDFs-{!! $value['id'] !!}">
                                    <td>PAGO DE {!! $value['quantity'] !!} {!! $value['name'] !!} DESDE
                                        {!! $value['start_time'] !!} HASTA {!! $value['end_time'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-up"
                                            style="font-size:18px;color:#00D0C4;"></i>
                                        ${!! number_format($value['payment'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_accrued({!! $value['id'] !!},'HENDFs', {!! $value['payment'] !!})"
                                            class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            @foreach ($HRNDFs as $value)
                                <tr id="HRNDFs-{!! $value['id'] !!}">
                                    <td>PAGO DE {!! $value['quantity'] !!} {!! $value['name'] !!} DESDE
                                        {!! $value['start_time'] !!} HASTA {!! $value['end_time'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-up"
                                            style="font-size:18px;color:#00D0C4;"></i>
                                        ${!! number_format($value['payment'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_accrued({!! $value['id'] !!},'HRNDFs', {!! $value['payment'] !!})"
                                            class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            @foreach ($work_disabilities as $value)
                                <tr id="work_disabilities-{!! $value['id'] !!}">
                                    <td>PAGO DE {!! $value['quantity'] !!} DIA(S) DE {!! $value['name'] !!} DESDE
                                        {!! $value['start_date'] !!} HASTA {!! $value['end_date'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-up"
                                            style="font-size:18px;color:#00D0C4;"></i>
                                        ${!! number_format($value['payment'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_accrued({!! $value['id'] !!},'work_disabilities', {!! $value['payment'] !!})"
                                            class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot style="background-color: #b5eee0;">
                            <tr align="center">
                                <th>TOTAL</th>
                                <th colspan="2"><i class="fa fa-sort-up" style="font-size:18px;color:#00D0C4;"></i>
                                    ${!! number_format($document->accrued_total, 2) !!}</th>
                            </tr>
                        </tfoot>
                    </table>
                    {!! Form::hidden('accrued', null, ['class' => 'form-control', 'id' => 'accrued']) !!}
                    {!! Form::hidden('accrued_total', null, ['class' => 'form-control', 'id' => 'accrued_total']) !!}

                    <input type="hidden" id="transportation_allowance_value"
                        value={{ $configuraciones->transport_allowance }}>

                </div>
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

                <div class="table-responsive">
                    <table id="tbl_deductions"
                        class="table table-bordered table-hover border-primary table-striped mt-2">

                        <tbody>

                            @php
                                $deducciones_json = json_decode($document->deductions, true);
                                
                                $eps_type_law_deduction = $deducciones_json['deducciones']['eps_type_law_deduction'];
                                $pension_type_law_deductions = $deducciones_json['deducciones']['pension_type_law_deductions'];
                                $other_deductions = $deducciones_json['deducciones']['other_deductions'];
                                $debt = $deducciones_json['deducciones']['debt'];
                                $voluntary_pension = $deducciones_json['deducciones']['voluntary_pension'];
                                $withholding_at_source = $deducciones_json['deducciones']['withholding_at_source'];
                                $afc = $deducciones_json['deducciones']['afc'];
                                $cooperative = $deducciones_json['deducciones']['cooperative'];
                                $tax_liens = $deducciones_json['deducciones']['tax_liens'];
                                $supplementary_plan = $deducciones_json['deducciones']['supplementary_plan'];
                                $education = $deducciones_json['deducciones']['education'];
                                $refund = $deducciones_json['deducciones']['refund'];
                                
                            @endphp

                            @if ($eps_type_law_deduction)
                                <tr id="eps_type_law_deduction-{!! $eps_type_law_deduction['id'] !!}">
                                    <td>DEDUCCION CORRESPONDIENTE A {!! $eps_type_law_deduction['name'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-down"
                                            style="font-size:18px;color:#FF267B;"></i>
                                        ${!! number_format($eps_type_law_deduction['value'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_deduccion({!! $eps_type_law_deduction['id'] !!}, 'Na', {!! $eps_type_law_deduction['value'] !!})"
                                            class="btn btn-icon disabled btn-sm btn-danger"><i
                                                class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                            @endif

                            @if ($pension_type_law_deductions)
                                <tr id="pension_type_law_deductions-{!! $pension_type_law_deductions['id'] !!}">
                                    <td>DEDUCCION CORRESPONDIENTE A {!! $pension_type_law_deductions['name'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-down"
                                            style="font-size:18px;color:#FF267B;"></i>
                                        ${!! number_format($pension_type_law_deductions['value'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_deduccion({!! $pension_type_law_deductions['id'] !!}, 'Na', {!! $pension_type_law_deductions['value'] !!})"
                                            class="btn btn-icon disabled btn-sm btn-danger"><i
                                                class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                            @endif


                            @foreach ($other_deductions as $value)
                                <tr id="other_deductions-{!! $value['id'] !!}">
                                    <td>DESCUENTO POR {!! $value['name'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-down"
                                            style="font-size:18px;color:#FF267B;"></i>
                                        ${!! number_format($value['value'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_deduccion({!! $value['id'] !!}, 'other_deductions', {!! $value['value'] !!})"
                                            class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach


                            @if ($debt)
                                <tr id="debt-3">
                                    <td>DESCUENTO POR {!! $debt['name'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-down"
                                            style="font-size:18px;color:#FF267B;"></i>
                                        ${!! number_format($debt['value'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_deduccion({!! $debt['id'] !!}, 'debt', {!! $debt['value'] !!})"
                                            class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    </td>

                                </tr>
                            @endif

                            @if ($voluntary_pension)
                                <tr id="voluntary_pension-4">
                                    <td>DESCUENTO POR {!! $voluntary_pension['name'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-down"
                                            style="font-size:18px;color:#FF267B;"></i>
                                        ${!! number_format($voluntary_pension['value'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_deduccion({!! $voluntary_pension['id'] !!}, 'voluntary_pension', {!! $voluntary_pension['value'] !!})"
                                            class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    </td>

                                </tr>
                            @endif

                            @if ($withholding_at_source)
                                <tr id="withholding_at_source-9">
                                    <td>DESCUENTO POR {!! $withholding_at_source['name'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-down"
                                            style="font-size:18px;color:#FF267B;"></i>
                                        ${!! number_format($withholding_at_source['value'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_deduccion({!! $withholding_at_source['id'] !!}, 'withholding_at_source', {!! $withholding_at_source['value'] !!})"
                                            class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    </td>

                                </tr>
                            @endif

                            @if ($afc)
                                <tr id="afc-1">
                                    <td>DESCUENTO POR {!! $afc['name'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-down"
                                            style="font-size:18px;color:#FF267B;"></i>
                                        ${!! number_format($afc['value'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_deduccion({!! $afc['id'] !!}, 'afc', {!! $afc['value'] !!})"
                                            class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    </td>

                                </tr>
                            @endif

                            @if ($cooperative)
                                <tr id="cooperative-7">
                                    <td>DESCUENTO POR {!! $cooperative['name'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-down"
                                            style="font-size:18px;color:#FF267B;"></i>
                                        ${!! number_format($cooperative['value'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_deduccion({!! $cooperative['id'] !!}, 'cooperative', {!! $cooperative['value'] !!})"
                                            class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    </td>

                                </tr>
                            @endif

                            @if ($tax_liens)
                                <tr id="tax_liens-2">
                                    <td>DESCUENTO POR {!! $tax_liens['name'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-down"
                                            style="font-size:18px;color:#FF267B;"></i>
                                        ${!! number_format($tax_liens['value'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_deduccion({!! $tax_liens['id'] !!}, 'tax_liens', {!! $tax_liens['value'] !!})"
                                            class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    </td>

                                </tr>
                            @endif

                            @if ($supplementary_plan)
                                <tr id="supplementary_plan-5">
                                    <td>DESCUENTO POR {!! $supplementary_plan['name'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-down"
                                            style="font-size:18px;color:#FF267B;"></i>
                                        ${!! number_format($supplementary_plan['value'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_deduccion({!! $supplementary_plan['id'] !!}, 'supplementary_plan', {!! $supplementary_plan['value'] !!})"
                                            class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    </td>

                                </tr>
                            @endif

                            @if ($education)
                                <tr id="education-6">
                                    <td>DESCUENTO POR {!! $education['name'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-down"
                                            style="font-size:18px;color:#FF267B;"></i>
                                        ${!! number_format($education['value'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_deduccion({!! $education['id'] !!}, 'education', {!! $education['value'] !!})"
                                            class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    </td>

                                </tr>
                            @endif

                            @if ($refund)
                                <tr id="refund-8">
                                    <td>DESCUENTO POR {!! $refund['name'] !!}</td>
                                    <td align="right"><i class="fa fa-sort-down"
                                            style="font-size:18px;color:#FF267B;"></i>
                                        ${!! number_format($refund['value'], 2) !!}</td>
                                    <td><a href="javascript:eliminar_deduccion({!! $refund['id'] !!}, 'refund', {!! $refund['value'] !!})"
                                            class="btn btn-icon btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    </td>

                                </tr>
                            @endif

                        </tbody>
                        <tfoot style="background-color: #f8cfcc;">
                            <tr align="center">
                                <th>TOTAL</th>
                                <th colspan="2"><i class="fa fa-sort-down" style="font-size:20px;color:#FF267B;"></i>
                                    ${!! number_format($document->deductions_total, 2) !!}</th>
                            </tr>
                        </tfoot>
                    </table>
                    {{--  --}}
                    {!! Form::hidden('deductions', null, ['class' => 'form-control', 'id' => 'deductions']) !!}
                    {!! Form::hidden('deductions_total', null, ['class' => 'form-control', 'id' => 'deductions_total']) !!}

                    {!! Form::hidden('payroll_total', null, ['class' => 'form-control', 'id' => 'payroll_total']) !!}
                    <input id="concepts_parafiscal" type="hidden"
                        value="{{ $document->company->concepts_parafiscal_contributions }}">

                </div>
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
                <button type="submit" class="btn btn-primary">Enviar Nomina de Ajuste</button>
            </div>
        </div>



    </div>
</div>
