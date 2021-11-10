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
                    </div>

                </div>
            </div>
        </div>


        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('payrolls.index') }}" method="get">
                                <div class="form-row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <input type="text" name="busqueda" id="txt_busqueda" class="form-control"
                                                    placeholder="Ndi, Nombre1, Apellido1" aria-label="">
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
                                                <td colspan="6">No hay resultados</td>
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
                                                    <i class="fas fa-user-clock" style="font-size:16px;color:#6777ef;">
                                                    </i><a href="{{ route('workers.show', $row->worker) }}">
                                                        {{ $row->worker->first_name . ' ' . $row->worker->surname }}</a>
                                                </td>

                                                <td colspan="4"><i class="fas fa-cloud-sun"
                                                        style="font-size:16px;color:#F8C471;"> Días trabajados:</i>
                                                    {{ $row->worked_days }}</td>
                                                {{-- <td>
                                                {!! Form::open(['method' => 'PUT', 'route' => ['payrolls.change_status', $row], 'style' => 'display:inline']) !!}

                                                @if ($row->payroll_status == 0)
                                                    {{ Form::button('Inactivo', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) }}
                                                @else
                                                    {{ Form::button('Activo', ['type' => 'submit', 'class' => 'btn btn-success btn-sm']) }}
                                                @endif
                                                {!! Form::close() !!}
                                            </td> --}}
                                                </tr>
                                                <tr>
                                                    <td style="display: none;">{{ $row->id }}</td>

                                                    <td>

                                                        @php
                                                            $devengados_json = json_decode($row->accrued, true);
                                                            
                                                            $salary = $devengados_json['devengados']['salary'];
                                                            $transportation_allowance = $devengados_json['devengados']['transportation_allowance'];
                                                            
                                                            $common_vacation = $devengados_json['devengados']['common_vacation'];
                                                            $paid_vacation = $devengados_json['devengados']['paid_vacation'];
                                                            $maternity_leave = $devengados_json['devengados']['maternity_leave'];
                                                            $paid_leave = $devengados_json['devengados']['paid_leave'];
                                                            $legal_strike = $devengados_json['devengados']['legal_strike'];
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


                                                        @if (count($legal_strike))
                                                            <hr
                                                                style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                        @endif
                                                        @foreach ($legal_strike as $value)
                                                            {!! $value['name'] . ':<br><strong> +' . number_format($value['payment'], 2) . '</strong>' !!} <br>
                                                        @endforeach


                                                    </td>
                                                    <td style="white-space:nowrap;"><i class="fa fa-sort-up"
                                                            style="font-size:18px;color:#00D0C4;"></i> $
                                                        {{ number_format($row->accrued_total, 2) }}</td>
                                                    <td>

                                                        @php
                                                            $deducciones_json = json_decode($row->deductions, true);
                                                            
                                                            $eps_type_law_deduction = $deducciones_json['deducciones']['eps_type_law_deduction'];
                                                            $pension_type_law_deductions = $deducciones_json['deducciones']['pension_type_law_deductions'];
                                                            $other_deductions = $deducciones_json['deducciones']['other_deductions'];
                                                            
                                                        @endphp

                                                        {!! $eps_type_law_deduction['name'] . ':<strong> -' . number_format($eps_type_law_deduction['value'], 2) . '</strong>' !!}
                                                        <hr
                                                            style="margin-top:0rem;margin-bottom:0rem;border-top:1px solid rgb(103 119 239)">
                                                        {!! $pension_type_law_deductions['name'] . ':<strong> -' . number_format($pension_type_law_deductions['value'], 2) . '</strong>' !!}

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


                                                    </td>
                                                    <td style="white-space:nowrap;"><i class="fa fa-sort-down"
                                                            style="font-size:18px;color:#FF267B;"></i> $
                                                        {{ number_format($row->deductions_total, 2) }}</td>
                                                    <td style="white-space:nowrap;"><i class="fa fa-equals"
                                                            style="font-size:15px;color:#00D0C4;"></i> $
                                                        {{ number_format($row->payroll_total, 2) }}</td>

                                                    <td>
                                                        <div class="btn-group dropleft" style="float:right;width:50px;">
                                                            <button
                                                                class="btn btn-sm btn-primary dropdown-toggle waves-light"
                                                                type="button" id="dropdown3" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false"><i
                                                                    class="fas fa-th-large"></i></button>
                                                            <div class="dropdown-menu dropleft">

                                                                {!! Form::open(['method' => 'GET', 'route' => ['payrolls.send_payroll', $row], 'style' => 'display:inline', 'class' => 'shotDina', 'id' => $row->id]) !!}

                                                                {!! Form::hidden('periodo_ni', null, ['id' => 'periodo_ni']) !!}
                                                                {!! Form::hidden('fecha_pago_ni', null, ['id' => 'fecha_pago_ni']) !!}

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
            Swal.fire("Oops...!", "{{ session()->get('message') }}", "error");
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
            var id = $(this).attr("id");

            var fechaPago = document.getElementById("payment_date").value;
            var periodo = document.getElementById("select_payroll_period_id").value;

            localStorage.setItem('periodo_ni', periodo);
            localStorage.setItem('fecha_pago_ni', fechaPago);


            $('input').each(function() {

                if (this.id == 'periodo_ni') {
                    this.value = periodo;
                }

                if (this.id == 'fecha_pago_ni') {
                    this.value = fechaPago;
                }

            });


            this.submit();

        });
    </script>
@endsection
