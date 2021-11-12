@extends('layouts.app')

@section('title')
    Empleados
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Documentos Emitidos</h3>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
                <div class="breadcrumb-item">Emitidos</div>
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
                    <h5>Filtros</h5>
                </div>
                <div class="card-block">

                    <div class="row">
                        <div class="col-sm-12 col-xl-6 m-b-30">
                            <div class="form-group">
                                {!! Html::decode(Form::label('payroll_period_id', 'Periodo de Nomina')) !!}
                                {!! Form::select('payroll_period_id', $periodo_nomina->pluck('description', 'id'), null, ['class' => 'form-control', 'id' => 'select_payroll_period_id', 'placeholder' => '-- Seleccionar --']) !!}
                                <div class="invalid-feedback">
                                    {{ $errors->first('payroll_period_id') }}
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-success">Aplicar filtro</button>
                </div>
            </div>
        </div>


        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('documents.index') }}" method="get">
                                <div class="form-row">

                                    <div class="col-lg-4 col-md-4 col-sm-12">
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

                                    <div class="col-lg-4 col-md-4 col-sm-12">
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
                                        <th style="color: #fff;">Periodo</th>
                                        <th style="color: #fff;">Serie</th>
                                        <th style="color: #fff;">Folio</th>
                                        <th style="color: #fff;">Total Devengados</th>
                                        <th style="color: #fff;">Total Deducciones</th>
                                        <th style="color: #fff;">Total Pago</th>
                                        <th class="text-right" style="color: #fff;">Acciones</th>
                                    </thead>
                                    <tbody>
                                        @if (count($documents) <= 0)
                                            <tr>
                                                <td colspan="7">
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
                                            @foreach ($documents as $row)

                                                <tr>
                                                    <td colspan="3">
                                                        {{ $row->worker->payroll_type_document_identification->name }} :
                                                        {{ $row->worker->identification_number }}<br>
                                                        <a href="{{ route('workers.show', $row->worker) }}"><img
                                                                src="{{ asset('img/avatar/avatar-1.png') }}" alt="avatar"
                                                                width="25" class="rounded-circle mr-1">
                                                            {{ $row->worker->first_name . ' ' . $row->worker->surname }}</a>
                                                    </td>

                                                    <td colspan="4" style="font-size:10px;"><i class="fas fa-terminal"
                                                            style="font-size:12px;color:#4de767;"> Cune:</i><br>
                                                        {{ $row->cune }}</td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        {{ $row->period->description . ' ' . $row->period->year }}
                                                    </td>
                                                    <td>
                                                        {{ $row->prefix }}
                                                    </td>
                                                    <td>
                                                        {{ $row->consecutive }}
                                                    </td>
                                                    <td style="white-space:nowrap;"><i class="fa fa-sort-up"
                                                            style="font-size:18px;color:#00D0C4;"></i> $
                                                        {{ number_format($row->accrued_total, 2) }}</td>

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

                                                                <a class="dropdown-item has-icon"
                                                                    href="{{ route('documents.download_apidian_payroll', array($row, 'pdf')) }}"><i
                                                                        class="far fa-file-pdf"></i> PDF</a>

                                                                        <a class="dropdown-item has-icon"
                                                                    href="{{ route('documents.download_apidian_payroll', array($row, 'xml')) }}"><i
                                                                        class="far fa-file"></i> XML</a>

                                                                <a class="dropdown-item has-icon"
                                                                    href="{{ $row->qrstr }}" target="_blank"><i
                                                                        class="fa fa-link"></i> Dian</a>

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
                                    {!! $documents->links() !!}
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
