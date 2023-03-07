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
                <div class="breadcrumb-item">Documentos Emitidos</div>
            </div>
        </div>

        <p class="section-lead">Listado de nóminas electrónicas que has emitido a la DIAN.
        </p>

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


        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">


                            <div class="form-row">

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
                                                <h4>Total nominas</h4>
                                            </div>
                                            <div class="card-body">
                                                {{ number_format($totalNominas, 2) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>



                            <div class="table-responsive">
                                <table class="table table-bordered table-hover border-primary table-striped mt-2">
                                    <thead style="background-color: #6777ef;">
                                        <th style="color: #fff;">Periodo</th>
                                        <th style="color: #fff;">Empleados</th>
                                        <th style="color: #fff;">Total Devengados</th>
                                        <th style="color: #fff;">Total Deducciones</th>
                                        <th style="color: #fff;">Total Pago</th>
                                        <th class="text-right" style="color: #fff;">Acciones</th>
                                    </thead>
                                    <tbody>
                                        @if (count($documentosAgrupados) <= 0)
                                            <tr>
                                                <td colspan="5">
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
                                            @foreach ($documentosAgrupados as $row)

                                                <tr>
                                                    <td>
                                                        {{ $row->period->description . ' ' . $row->period->year }}
                                                    </td>

                                                    <td>
                                                        {{ $row->nworkers }}
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


                                                        <td class="text-right">
                                                            {!! Form::open(['method' => 'GET', 'route' => 'documents.show', 'style' => 'display:inline']) !!}

                                                            {!! Form::hidden('period_id', $row->period_id) !!}

                                                            {!! Form::button('<i class="fas fa-eye"></i>', ['type' => 'submit', 'class' => 'btn btn-light btn-sm btn-icon']) !!}

                                                            {!! Form::close() !!}


                                                        </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <div class="pagination justify-content-end">
                                    {!! $documentosAgrupados->links() !!}
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
