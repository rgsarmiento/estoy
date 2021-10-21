@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                @can('usuarios.index')
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-blue order-card">
                                            <div class="card-block">
                                                <h5>Usuarios</h5>
                                                <h2 class="text-right"><i
                                                        class="fa fa-users f-left"></i><span>{{ $cantidad_usuarios }}</span>
                                                </h2>
                                                <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver
                                                        más</a></p>
                                            </div>
                                        </div>
                                    </div>
                                @endcan

                                @can('companies.index')
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-green order-card">
                                            <div class="card-block">
                                                <h5>Empresas</h5>
                                                <h2 class="text-right"><i
                                                        class="fa fa-briefcase f-left"></i><span>{{ $cantidad_empresas }}</span>
                                                </h2>
                                                <p class="m-b-0 text-right"><a href="/companies" class="text-white">Ver
                                                        más</a></p>
                                            </div>
                                        </div>
                                    </div>
                                @endcan

                                @can('workers.index')
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-pink order-card">
                                            <div class="card-block">
                                                <h5>Empleados</h5>
                                                <h2 class="text-right"><i
                                                        class="fa fa-people-carry f-left"></i><span>{{ $cantidad_empleados }}</span>
                                                </h2>
                                                <p class="m-b-0 text-right"><a href="/workers" class="text-white">Ver
                                                        más</a></p>
                                            </div>
                                        </div>
                                    </div>
                                @endcan




                            </div>

                            <div class="row">

                                <div class="col-12 col-md-7">
                                    <div class="card shadow-sm">
                                        <div class="card-body">
                                            <h2><i class="icon-star"></i> Valores de Salario Mínimo {{date("Y")}}</h2>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Concepto</th>
                                                            <th>Valor</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <h5>Salario Mensual - Mes (SMMLV)</h5><small>30 días</small>
                                                            </td>
                                                            <td class="float-right">$ {{ number_format($configuraciones->minimum_salary, 2) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h5>Salario Quincenal - Quicena (SMQLV)</h5><small>15
                                                                    días</small>
                                                            </td>
                                                            <td class="float-right">$
                                                                {{ number_format($configuraciones->minimum_salary / 2, 2) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h5>Salario Diario - Día (SMDLV)</h5><small>8 horas</small>
                                                            </td>
                                                            <td class="float-right">$
                                                                {{ number_format($configuraciones->minimum_salary / 30, 2) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h5>Hora Ordinaria</h5><small>(6 A.M. a 9 P.M.)</small>
                                                            </td>
                                                            <td class="float-right">$
                                                                {{ number_format(json_decode($configuraciones->ordinary_time)->value, 2) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h5>Hora Nocturna</h5><small>(9 P.M. a 6 A.M.) +35%
                                                                    noct.</small>
                                                            </td>
                                                            <td class="float-right">$
                                                                {{ number_format(json_decode($configuraciones->night_time)->value, 2) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h5>Hora Extra Diurna</h5><small>(6 A.M. a 9 P.M.) +25%
                                                                    extra</small>
                                                            </td>
                                                            <td class="float-right">$
                                                                {{ number_format(json_decode($configuraciones->extra_daytime)->value, 2) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h5>Hora Extra Nocturna</h5><small>(9 P.M. a 6 A.M.) +75%
                                                                    extra</small>
                                                            </td>
                                                            <td class="float-right">$
                                                                {{ number_format(json_decode($configuraciones->overtime_night)->value, 2) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h5>Hora Extra Dominical/Festivo Diurna</h5><small>(6 A.M. a
                                                                    9 P.M.) +75% Fest. +25% extra</small>
                                                            </td>
                                                            <td class="float-right">$
                                                                {{ number_format(json_decode($configuraciones->sunday_extra_daytime)->value, 2) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h5>Hora Extra Dominical/Festivo Nocturna</h5><small>(9 P.M.
                                                                    a 6 A.M.) +75% Fest. +75% extra</small>
                                                            </td>
                                                            <td class="float-right">$
                                                                {{ number_format(json_decode($configuraciones->sunday_night_overtime)->value, 2) }}
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <h5>Subsidio de transporte Mensual</h5><small>30
                                                                    días</small>
                                                            </td>
                                                            <td class="float-right">$
                                                                {{ number_format($configuraciones->transport_allowance, 2) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h5>Subsidio de transporte Quincenal</h5><small>15
                                                                    días</small>
                                                            </td>
                                                            <td class="float-right">$
                                                                {{ number_format($configuraciones->transport_allowance / 2, 2) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h5>Subsidio de transporte Diario</h5><small>1 día</small>
                                                            </td>
                                                            <td class="float-right">$
                                                                {{ number_format($configuraciones->transport_allowance / 30, 2) }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
