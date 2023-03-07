@extends('layouts.app')

@section('title')
    Empleados
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Empleado detalle</h3>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="home">Dashboard</a></div>
                <div class="breadcrumb-item active"> <a href="{{ route('workers.index') }}">Empleados</a></div>
                <div class="breadcrumb-item">Empleado detalle</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-body">

                            @can('workers.editar')
                                <div class="btn-group dropleft float-right">
                                    <a class="btn btn-warning btn-icon icon-left"
                                        href="{{ route('workers.edit', $worker->id) }}"><i class="fas fa-edit"></i>
                                        Editar</a>
                                </div>
                            @endcan

                            <div class="card-block">
                                <div class="row">
                                    <div class="col-sm-12 col-xl-12 m-b-30">
                                        <strong><i class="fas fa-info mr-1"></i> Estado</strong>
                                        <p class="text-muted">
                                            @if ($worker->status == 'ACTIVO')
                                                <span class="badge badge-success">{{ $worker->status }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ $worker->status }}</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="card-header">
                                <h5><span class="text-primary">Popiedad</span></h5>
                            </div>



                            <div class="card-block">
                                <div class="row">
                                    <div class="col-sm-12 col-xl-12 m-b-30">
                                        <strong><i class="fas fa-building mr-1"></i> Empresa</strong>
                                        <p class="text-muted">
                                            {{ $worker->company->name }}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-user-circle mr-1"></i> Usuario</strong>
                                        <p class="text-muted">
                                            {{ $worker->user->name }}
                                        </p>
                                    </div>
                                </div>
                            </div>


                            <div class="card-header">
                                <h5><span class="text-primary">Informacion Basica</span></h5>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-sm-12 col-xl-12 m-b-30">
                                        <strong><i class="fas fa-id-card mr-1"></i>
                                            {{ $worker->payroll_type_document_identification->name }}</strong>
                                        <p class="text-muted">
                                            {{ $worker->identification_number }}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-street-view mr-1"></i> Nombre</strong>
                                        <p class="text-muted">
                                            {{ $worker->first_name . ' ' . $worker->second_name . ' ' . $worker->surname . ' ' . $worker->second_surname }}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-map-marked-alt mr-1"></i> Direccion</strong>
                                        <p class="text-muted">
                                            {{ $worker->address . ' (' . $worker->municipality->name . '-' . $worker->municipality->department->name . ')' }}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-mobile-alt mr-1"></i> Telefono</strong>
                                        <p class="text-muted">
                                            {{ $worker->telephone }}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-envelope mr-1"></i> E-mail</strong>
                                        <p class="text-muted">
                                            {{ $worker->email }}
                                        </p>
                                    </div>
                                </div>
                            </div>




                            <div class="card-header">
                                <h5><span class="text-primary">Informacion Laboral</span></h5>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-sm-12 col-xl-12 m-b-30">
                                        <strong><i class="fas fa-book-reader mr-1"></i> Tipo Contrato</strong>
                                        <p class="text-muted">
                                            {{ $worker->type_contract->name }}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-calendar-alt mr-1"></i> Fecha Admision</strong>
                                        <p class="text-muted">
                                            {{ $worker->admision_date }}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-bookmark mr-1"></i> Tipo y Sub Tipo Empleado</strong>
                                        <p class="text-muted">
                                            {{ $worker->type_worker->name . ' - ' . $worker->sub_type_worker->name }}
                                        </p>
                                        <strong><i class="fas fa-calendar-day mr-1"></i> Periodo Nomina</strong>
                                        <p class="text-muted">
                                            {{ $worker->payroll_period->name }}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-blind mr-1"></i> Pension de alto Riesgo</strong>
                                        <p class="text-muted">
                                            @if ($worker->high_risk_pension == 1)
                                                SI
                                            @else
                                                NO
                                            @endif
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-minus-circle mr-1"></i> EPS Tipo Deduccion</strong>
                                        <p class="text-muted">
                                            {{ $worker->type_salud_law_deduction->name . ' (%' . $worker->type_salud_law_deduction->percentage . ')' }}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-minus-circle mr-1"></i> Pension Tipo Deduccion</strong>
                                        <p class="text-muted">
                                            {{ $worker->type_pension_law_deduction->name . ' (%' . $worker->type_pension_law_deduction->percentage . ')' }}
                                        </p>
                                        <hr>

                                    </div>
                                </div>
                            </div>


                            <div class="card-header">
                                <h5><span class="text-primary">Informacion Salarial</span></h5>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-sm-12 col-xl-12 m-b-30">
                                        <strong><i class="fas fa-dollar-sign mr-1"></i> Salario</strong>
                                        <p class="text-muted">
                                            {{ number_format($worker->salary, 2) }}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-hand-holding-usd mr-1"></i> Salario Integral</strong>
                                        <p class="text-muted">
                                            @if ($worker->integral_salarary == 1)
                                                SI
                                            @else
                                                NO
                                            @endif
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-bus mr-1"></i> Subsidio de Transporte</strong>
                                        <p class="text-muted">
                                            @if ($worker->transportation_allowance == 1)
                                                SI
                                            @else
                                                NO
                                            @endif
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-wallet mr-1"></i> Metodo de Pago</strong>
                                        <p class="text-muted">
                                            {{ $worker->payment_method->name }}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-university mr-1"></i> Banco</strong>
                                        <p class="text-muted">
                                            {{ $worker->bank_name }}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-file-invoice mr-1"></i> Tipo Cuenta</strong>
                                        <p class="text-muted">
                                            {{ $worker->account_type }}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-hashtag mr-1"></i> Numero Cuenta</strong>
                                        <p class="text-muted">
                                            {{ $worker->account_number }}
                                        </p>
                                        <hr>

                                    </div>
                                </div>
                            </div>


                        </div>



                        <div class="card-footer text-muted">
                            <a href="{{ route('workers.index') }}"
                                class="btn btn-primary btn-icon icon-left float-right"><i
                                    class="fas fa-arrow-circle-left"></i> Regresar</a>
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

@endsection
