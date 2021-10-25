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
                                {!! Form::date('payment_date', null, ['class' => 'form-control']) !!}
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

                            <div class="table-responsive">
                                <table class="table table-bordered border-primary table-striped mt-2">
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
                                        @foreach ($payrolls as $row)
                                            @if ($row->payroll_status == 0)
                                                <tr style="background-color: #FFE9E3;">
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
                                            <td colspan="3"><i class="fas fa-cloud-sun"
                                                    style="font-size:16px;color:#F8C471;"> Días trabajados:</i>
                                                {{ $row->worked_days }}</td>
                                            <td>
                                                {!! Form::open(['method' => 'PUT', 'route' => ['payrolls.change_status', $row], 'style' => 'display:inline']) !!}

                                                @if ($row->payroll_status == 0)
                                                    {{ Form::button('Inactivo', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) }}
                                                @else
                                                    {{ Form::button('Activo', ['type' => 'submit', 'class' => 'btn btn-success btn-sm']) }}
                                                @endif
                                                {!! Form::close() !!}
                                            </td>
                                            </tr>
                                            <tr>
                                                <td style="display: none;">{{ $row->id }}</td>

                                                <td>
                                                    @foreach (json_decode($row->accrued, true) as $value)
                                                        {!! $value['name'] . ':<br><strong> +' . number_format($value['value'], 2) . '</strong>' !!} <br>
                                                    @endforeach
                                                </td>
                                                <td style="white-space:nowrap;"><i class="fa fa-sort-up"
                                                        style="font-size:18px;color:#00D0C4;"></i> $
                                                    {{ number_format($row->accrued_total, 2) }}</td>
                                                <td>
                                                    @foreach (json_decode($row->deductions, true) as $value)
                                                        {!! $value['name'] . ':<strong> -' . number_format($value['value'], 2) . '</strong>' !!} <br>
                                                    @endforeach
                                                </td>
                                                <td style="white-space:nowrap;"><i class="fa fa-sort-down"
                                                        style="font-size:18px;color:#FF267B;"></i> $
                                                    {{ number_format($row->deductions_total, 2) }}</td>
                                                <td style="white-space:nowrap;"><i class="fa fa-equals"
                                                        style="font-size:15px;color:#00D0C4;"></i> $
                                                    {{ number_format($row->payroll_total, 2) }}</td>

                                                <td>
                                                    <div class="btn-group dropleft" style="float:right;width:50px;">
                                                        <button class="btn btn-sm btn-primary dropdown-toggle waves-light"
                                                            type="button" id="dropdown3" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false"><i
                                                                class="fas fa-th-large"></i></button>
                                                        <div class="dropdown-menu dropleft">
                                                            <a class="dropdown-item has-icon"
                                                                href="{{ route('payrolls.send_apidian_payroll', $row) }}"><i
                                                                    class="far fa-share-square"></i> Enviar DIAN</a>
                                                            <a class="dropdown-item has-icon" href="#"><i
                                                                    class="far fa-edit"></i> Modificar</a>

                                                        </div>
                                                        <!-- end of dropdown menu -->
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination justify-content-end">

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
        window.setTimeout(function() {
            $(".alert").fadeTo(1500, 0).slideDown(1000,
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

@endsection