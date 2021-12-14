@extends('layouts.app')

@section('title')
    Empleados
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Generar Comprobantes</h3>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
                <div class="breadcrumb-item">Comprobantes</div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show alert-has-icon p-4" role="alert">
                <div class="alert-icon"><i class="fa fa-lightbulb"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Oh, no!</div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif





        {!! Form::open(['route' => 'payrolls.payroll_period_in_progress', 'method' => 'POST']) !!}

        @if ($payroll_period_progress)

            <p class="section-lead">Detalle del periodo de emisión de nómina.
            </p>

            <div class="row" style="display:flex;">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <table>
                                <tbody>
                                    <tr>
                                        <td style=" width: 100%;text-align: center;">
                                            <div class="profile-widget-name">
                                                <h6>Progreso de la emisión</h6>
                                            </div>
                                            <p>Se han emitido {!! $documents->count() !!} de {!! $nRegistros !!} empleados.
                                            </p>

                                        </td>
                                        <td style=" width: 50%;text-align: center;">
                                            <div class="bg">
                                                <div class="circle-right">
                                                    <div class="mask-right" style="transform:rotate(36deg)"></div>
                                                </div>
                                                <div class="text">{!! ($documents->count() / $nRegistros) * 100 !!}%</div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <table style=" width: 100%;">
                                <tbody>
                                    <tr>
                                        <td style=" width: 50%;text-align: left;">
                                            <div class="profile-widget-name">
                                                <h6>Periodo</h6>
                                            </div>
                                        </td>
                                        <td style=" width: 100%;text-align: right;">
                                            {!! $payroll_period_progress->period->description !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <hr>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td style=" width: 50%;text-align: left;">
                                            <div class="profile-widget-name">
                                                <h6>Estado</h6>
                                            </div>
                                        </td>
                                        <td style=" width: 100%;text-align: right;">

                                            @if ($nRegistros - $documents->count() == 0)
                                                <div class="text-success mb-2">
                                                    <h6>Completado</h6>
                                                </div>
                                            @else
                                                <div class="text-warning mb-2">
                                                    <h6>En proceso</h6>
                                                </div>
                                            @endif


                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <div class="card card-primary">
                <div class="card-body">
                    <div class="card-header">
                        <h5>Periodo de Nomina</h5>
                    </div>
                    <div class="card-block">
                        <div class="row">

                            <div class="col-sm-12 col-xl-6 m-b-30">
                                <div class="form-group">
                                    {!! Html::decode(Form::label('payroll_period_id', 'Periodo de Nomina<span class="text-danger">(*)</span>')) !!}
                                    {!! Form::select('payroll_period_id', $periodo_nomina->pluck('description', 'id'), null, ['class' => 'form-control', 'id' => 'select_payroll_period_id', 'placeholder' => '-- Seleccionar --']) !!}
                                    <div class="invalid-feedback">
                                        {{ $errors->first('payroll_period_id') }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-xl-3 m-b-30">
                                <div class="form-group">
                                    {!! Html::decode(Form::label('payment_date', 'Fecha de Pago<span class="text-danger">(*)</span>')) !!}
                                    {!! Form::date('payment_date', null, ['class' => 'form-control', 'id' => 'payment_date']) !!}
                                    <div class="invalid-feedback">
                                        {{ $errors->first('payment_date') }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-xl-3 m-b-30">
                                <div class="form-group">
                                    <br>
                                    <button type="submit" class="btn btn-success">Aplicar Perido
                                        Nómina</button>
                                </div>
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endif

        <div class="form-row">

            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">

                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Emiciones aceptadas</h4>
                        </div>
                        <div class="card-body">
                            @if ($documents != null)
                                {!! $documents->count() !!}
                            @else
                                0
                            @endif

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="card card-statistic-2">

                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-archive"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Registros</h4>
                        </div>
                        <div class="card-body">
                            {{ $nRegistros }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-4 col-sm-12">
                <div class="card card-statistic-2">

                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total nomina</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($totalNomina, 2) }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <p class="section-lead">Estos son los empleados que se incluirán en la nómina del periodo seleccionado, emite sus
            nomina uno a uno.
        </p>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('payrolls.index') }}" method="get">
                                <div class="form-row">

                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <input type="search" name="busqueda" id="txt_busqueda"
                                                    class="form-control" placeholder="Buscar" aria-label="">
                                                <div class="input-group-append">
                                                    <input type="submit" class="btn btn-primary" value="Buscar">
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover border-primary table-striped mt-2">
                                    <thead style="background-color: #6777ef;">
                                        <th style="display: none;">Id</th>
                                        <th style="color: #fff;">Devengados</th>
                                        <th style="color: #fff;">Total Devengados</th>
                                        <th style="color: #fff;">Deducciones</th>
                                        <th style="color: #fff;">Total Deducciones</th>
                                        <th style="color: #fff;">Total Pagar</th>
                                        <th class="text-right" style="color: #fff;">Acciones</th>
                                    </thead>
                                    <tbody>
                                        @if (count($payrolls) <= 0)
                                            <tr>
                                                <td colspan="6">
                                                    <div class="card-body">
                                                        <div class="empty-state" data-height="400"
                                                            style="height: 400px;">
                                                            <div class="empty-state-icon">
                                                                <img src="{{ asset('img/avatar/oops.png') }}" alt="avatar"
                                                                    width="70">
                                                            </div>
                                                            <h2>No hay registros para mostrar</h2>
                                                            <p class="lead">
                                                                Todos los registros existentes se mostrarán aquí.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($payrolls as $row)
                                                @if ($row->payroll_status == 2)
                                                    <tr class="bg-c-dian">
                                                    @else
                                                    <tr>
                                                @endif

                                                <td colspan="2">
                                                    {{ $row->worker->payroll_type_document_identification->name }} :
                                                    {{ $row->worker->identification_number }}<br>
                                                    <a href="{{ route('workers.show', $row->worker) }}"><img
                                                            src="{{ asset('img/avatar/avatar-1.png') }}" alt="avatar"
                                                            width="25" class="rounded-circle mr-1">
                                                        {{ $row->worker->first_name . ' ' . $row->worker->surname }}</a>
                                                </td>

                                                <td colspan="4"><i class="fas fa-cloud-sun"
                                                        style="font-size:16px;color:#F8C471;"> Días trabajados:</i>
                                                    {{ $row->worked_days }}</td>

                                                </tr>
                                                <tr>
                                                    <td style="display: none;">{{ $row->id }}</td>

                                                    <td style="font-size:12px">

                                                        @php
                                                            $devengados_json = json_decode($row->accrued, true);
                                                            
                                                            $salary = $devengados_json['devengados']['salary'];
                                                            $transportation_allowance = $devengados_json['devengados']['transportation_allowance'];
                                                            
                                                            $common_vacation = $devengados_json['devengados']['common_vacation'];
                                                            $paid_vacation = $devengados_json['devengados']['paid_vacation'];
                                                            $maternity_leave = $devengados_json['devengados']['maternity_leave'];
                                                            $paid_leave = $devengados_json['devengados']['paid_leave'];
                                                            $non_paid_leave = $devengados_json['devengados']['non_paid_leave'];
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

                                                        {!! $salary['name'] . ':<br><strong> +' . number_format($salary['value'], 2) . '</strong>' !!}

                                                        @if (count($transportation_allowance))
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                            {!! $transportation_allowance['name'] . ':<br><strong> +' . number_format($transportation_allowance['value'], 2) . '</strong>' !!}
                                                        @endif

                                                        @if (count($common_vacation))
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                        @endif
                                                        @foreach ($common_vacation as $value)
                                                            {!! $value['name'] . ':<br><strong> +' . number_format($value['payment'], 2) . '</strong>' !!} <br>
                                                        @endforeach


                                                        @if (count($paid_vacation))
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                        @endif
                                                        @foreach ($paid_vacation as $value)
                                                            {!! $value['name'] . ':<br><strong> +' . number_format($value['payment'], 2) . '</strong>' !!} <br>
                                                        @endforeach


                                                        @if (count($maternity_leave))
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                        @endif
                                                        @foreach ($maternity_leave as $value)
                                                            {!! $value['name'] . ':<br><strong> +' . number_format($value['payment'], 2) . '</strong>' !!} <br>
                                                        @endforeach


                                                        @if (count($paid_leave))
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                        @endif
                                                        @foreach ($paid_leave as $value)
                                                            {!! $value['name'] . ':<br><strong> +' . number_format($value['payment'], 2) . '</strong>' !!} <br>
                                                        @endforeach

                                                        @if (count($non_paid_leave))
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                        @endif
                                                        @foreach ($non_paid_leave as $value)
                                                            {!! $value['name'] . ':<br><strong> +' . number_format($value['payment'], 2) . '</strong>' !!} <br>
                                                        @endforeach


                                                        @if (count($legal_strike))
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                        @endif
                                                        @foreach ($legal_strike as $value)
                                                            {!! $value['name'] . ':<br><strong> +' . number_format($value['payment'], 2) . '</strong>' !!} <br>
                                                        @endforeach

                                                        @if (count($HEDs))
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                        @endif
                                                        @foreach ($HEDs as $value)
                                                            {!! '(' . $value['quantity'] . ')' . ' ' . $value['name'] . ':<br><strong> +' . number_format($value['payment'], 2) . '</strong>' !!} <br>
                                                        @endforeach

                                                        @if (count($HENs))
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                        @endif
                                                        @foreach ($HENs as $value)
                                                            {!! '(' . $value['quantity'] . ')' . ' ' . $value['name'] . ':<br><strong> +' . number_format($value['payment'], 2) . '</strong>' !!} <br>
                                                        @endforeach

                                                        @if (count($HRNs))
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                        @endif
                                                        @foreach ($HRNs as $value)
                                                            {!! '(' . $value['quantity'] . ')' . ' ' . $value['name'] . ':<br><strong> +' . number_format($value['payment'], 2) . '</strong>' !!} <br>
                                                        @endforeach

                                                        @if (count($HEDDFs))
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                        @endif
                                                        @foreach ($HEDDFs as $value)
                                                            {!! '(' . $value['quantity'] . ')' . ' ' . $value['name'] . ':<br><strong> +' . number_format($value['payment'], 2) . '</strong>' !!} <br>
                                                        @endforeach

                                                        @if (count($HRDDFs))
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                        @endif
                                                        @foreach ($HRDDFs as $value)
                                                            {!! '(' . $value['quantity'] . ')' . ' ' . $value['name'] . ':<br><strong> +' . number_format($value['payment'], 2) . '</strong>' !!} <br>
                                                        @endforeach

                                                        @if (count($HENDFs))
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                        @endif
                                                        @foreach ($HENDFs as $value)
                                                            {!! '(' . $value['quantity'] . ')' . ' ' . $value['name'] . ':<br><strong> +' . number_format($value['payment'], 2) . '</strong>' !!} <br>
                                                        @endforeach

                                                        @if (count($HRNDFs))
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                        @endif
                                                        @foreach ($HRNDFs as $value)
                                                            {!! '(' . $value['quantity'] . ')' . ' ' . $value['name'] . ':<br><strong> +' . number_format($value['payment'], 2) . '</strong>' !!} <br>
                                                        @endforeach

                                                        @if (count($work_disabilities))
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                        @endif
                                                        @foreach ($work_disabilities as $value)
                                                            {!! $value['name'] . ':<br><strong> +' . number_format($value['payment'], 2) . '</strong>' !!} <br>
                                                        @endforeach


                                                    </td>
                                                    <td style="white-space:nowrap;"><i class="fa fa-sort-up"
                                                            style="font-size:18px;color:#00D0C4;"></i> $
                                                        {{ number_format($row->accrued_total, 2) }}</td>
                                                   
                                                   
                                                        <td style="font-size:12px">

                                                        @php
                                                            $deducciones_json = json_decode($row->deductions, true);
                                                            
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
                                                        {!! $eps_type_law_deduction['name'] . ':<strong> -' . number_format($eps_type_law_deduction['value'], 2) . '</strong>' !!}
                                                        @endif
                                                       
                                                        @if ($pension_type_law_deductions)
                                                        <hr
                                                            style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                        {!! $pension_type_law_deductions['name'] . ':<strong> -' . number_format($pension_type_law_deductions['value'], 2) . '</strong>' !!}
                                                        @endif

                                                        @if (count($other_deductions))
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                        @endif

                                                        @foreach ($other_deductions as $value)
                                                            {!! $value['name'] . ':<br><strong> -' . number_format($value['value'], 2) . '</strong>' !!} <br>
                                                        @endforeach

                                                        @if (count($other_deductions))
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                        @endif

                                                        @if ($debt)
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                            {!! $debt['name'] . ':<strong> -' . number_format($debt['value'], 2) . '</strong>' !!}
                                                        @endif

                                                        @if ($voluntary_pension)
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                            {!! $voluntary_pension['name'] . ':<strong> -' . number_format($voluntary_pension['value'], 2) . '</strong>' !!}
                                                        @endif

                                                        @if ($withholding_at_source)
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                            {!! $withholding_at_source['name'] . ':<strong> -' . number_format($withholding_at_source['value'], 2) . '</strong>' !!}
                                                        @endif

                                                        @if ($afc)
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                            {!! $afc['name'] . ':<strong> -' . number_format($afc['value'], 2) . '</strong>' !!}
                                                        @endif

                                                        @if ($cooperative)
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                            {!! $cooperative['name'] . ':<strong> -' . number_format($cooperative['value'], 2) . '</strong>' !!}
                                                        @endif

                                                        @if ($tax_liens)
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                            {!! $tax_liens['name'] . ':<strong> -' . number_format($tax_liens['value'], 2) . '</strong>' !!}
                                                        @endif

                                                        @if ($supplementary_plan)
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                            {!! $supplementary_plan['name'] . ':<strong> -' . number_format($supplementary_plan['value'], 2) . '</strong>' !!}
                                                        @endif

                                                        @if ($education)
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                            {!! $education['name'] . ':<strong> -' . number_format($education['value'], 2) . '</strong>' !!}
                                                        @endif

                                                        @if ($refund)
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                            {!! $refund['name'] . ':<strong> -' . number_format($refund['value'], 2) . '</strong>' !!}
                                                        @endif


                                                    </td>
                                                    <td style="white-space:nowrap;"><i class="fa fa-sort-down"
                                                            style="font-size:18px;color:#FF267B;"></i> $
                                                        {{ number_format($row->deductions_total, 2) }}</td>
                                                    <td style="white-space:nowrap;"><i class="fa fa-equals"
                                                            style="font-size:15px;color:#00D0C4;"></i> $
                                                        {{ number_format($row->payroll_total, 2) }}</td>

                                                    <td>
                                                        <div class="btn-group dropleft" style="float:right;width:50px;">
                                                            <button class="btn btn-sm btn-light  waves-light" type="button"
                                                                id="dropdown3" data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-h"></i></button>
                                                            <div class="dropdown-menu dropleft">

                                                                {!! Form::open(['method' => 'GET', 'route' => ['payrolls.send_payroll', $row], 'style' => 'display:inline', 'class' => 'shotDina', 'id' => $row->id]) !!}
                                                                @if ($row->payroll_status == 2)
                                                                @else
                                                                    {!! Form::button('<i class="far fa-share-square"></i> Enviar DIAN', ['type' => 'submit', 'class' => 'dropdown-item btn-link me-2', 'data-id' => $row->id]) !!}
                                                                @endif
                                                                {!! Form::close() !!}

                                                                <a class="dropdown-item has-icon"
                                                                    href="{{ route('payrolls.edit', $row->id) }}"><i
                                                                        class="far fa-edit"></i> Modificar</a>

                                                            </div>
                                                            <!-- end of dropdown menu -->
                                                        </div>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <div class="pagination justify-content-end">
                                    {!! $payrolls->links() !!}
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            //Código que se ejecutará al cargar la página
            var queryString = window.location.search;
            var urlParams = new URLSearchParams(queryString);

            if (urlParams.has('busqueda')) {
                document.getElementById("txt_busqueda").value = urlParams.get('busqueda');
            }


            if (localStorage.fecha_pago_ni === undefined) {} else {
                document.getElementById("payment_date").value = localStorage.getItem('fecha_pago_ni');
                localStorage.removeItem('fecha_pago_ni');
            }

            if (localStorage.periodo_ni === undefined) {} else {
                document.getElementById("select_payroll_period_id").value = localStorage.getItem('periodo_ni');
                localStorage.removeItem('periodo_ni');
            }




        });
    </script>

    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(9000, 0).slideDown(1000,
                function() {
                    $(this).remove();
                });
        }, 3000);
    </script>

    @if (Session::has('message'))
        <script>
            Swal.fire("Buen trabajo!", "{{ session()->get('message') }}", "success");
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            Swal.fire("Oops...!", "{{ session()->get('error') }}", "error");
        </script>
    @endif

    @if (Session::has('eliminar'))
        <script>
            Swal.fire("Eliminado!", "{{ session()->get('eliminar') }}", "success");
        </script>
    @endif


    @if (Session::has('change_status'))
        <script>
            Swal.fire("Actualizado!", "{{ session()->get('change_status') }}", "success");
        </script>
    @endif

    <script>
        $('.form-delete').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Esta seguro?',
                text: "Este empleado se eliminara definitivamente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>

    <script>
        $('.shotDina').submit(function(e) {
            e.preventDefault();
            $('.loader').show();
            this.submit();
            /* var id = $(this).attr("id");

            var fechaPago = document.getElementById("payment_date").value;
            var periodo = document.getElementById("select_payroll_period_id").value;

            localStorage.setItem('periodo_ni', periodo);
            localStorage.setItem('fecha_pago_ni', fechaPago);

            $('.loader').show();
            $('input').each(function() {

                if (this.id == 'periodo_ni') {
                    this.value = periodo;
                }

                if (this.id == 'fecha_pago_ni') {
                    this.value = fechaPago;
                }

            });


            this.submit(); */

        });
    </script>


    <script>
        $(window).on("load", function() {
            $(function() {
                // Obtener el valor porcentual
                var num = parseInt($('.text').html());

                // Muestra el porcentaje de progreso de la transición a través de un temporizador
                var temp = 0;
                var timer = setInterval(function() {
                    calculate(temp);
                    // Limpia el temporizador para finalizar la llamada al método
                    if (temp == num) {
                        clearInterval(timer);
                    }
                    temp++;
                }, 10)

                // Cambiar el porcentaje de visualización de la página
                function calculate(value) {
                    // Cambiar el valor mostrado en la página
                    $('.text').html(value + '%');

                    // Limpia el efecto residual de la última llamada a este método
                    $('.circle-left').remove();
                    $('.mask-right').remove();

                    // Cuando el porcentaje es menor o igual a 50
                    if (value <= 50) {
                        var html = '';

                        html += '<div class="mask-right" style="transform:rotate(' + (value * 3.6) +
                            'deg)"></div>';

                        // Agrega elementos secundarios al elemento
                        $('.circle-right').append(html);
                    } else {
                        value -= 50;
                        var html = '';

                        html += '<div class="circle-left">';
                        html += '<div class="mask-left" style="transform:rotate(' + (value * 3.6) +
                            'deg)"></div>';
                        html += '</div>';

                        // Agregar elemento tras elemento
                        $('.circle-right').after(html);
                    }
                }
            })
        });
    </script>
@endsection
