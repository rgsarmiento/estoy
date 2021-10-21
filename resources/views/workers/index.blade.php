@extends('layouts.app')

@section('title')
    Empleados
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Empleados</h3>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
                <div class="breadcrumb-item">Empleados</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            @can('workers.crear')
                                <a href="{{ route('workers.create') }}" class="btn btn-info btn-icon icon-left"><i
                                        class="fas fa-plus"></i> Nuevo Empleado</a>
                            @endcan

                            <div class="btn-group dropleft" style="float:right;width:50px;">
                                <button class="btn btn-sm btn-primary dropdown-toggle waves-light" type="button"
                                    id="dropdown3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                        class="fas fa-bars"></i></button>
                                <div class="dropdown-menu dropleft">
                                    <a class="dropdown-item has-icon" href="#"><i class="far fa-heart"></i> Action</a>
                                    <a class="dropdown-item has-icon" href="#"><i class="far fa-file"></i> Another
                                        action</a>
                                    <a class="dropdown-item has-icon" href="#"><i class="far fa-clock"></i> Something else
                                        here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                            class="icofont icofont-edit-alt m-r-10"></i>Edit task</a>
                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                            class="icofont icofont-close m-r-10"></i>Remove</a>
                                </div>
                                <!-- end of dropdown menu -->
                            </div>

                            <table class="table table-bordered table-striped mt-2">
                                <thead style="background-color: #6777ef;">
                                    <th style="display: none;">Id</th>
                                    <th style="color: #fff;">NDI</th>
                                    <th style="color: #fff;">Nombre</th>
                                    <th style="color: #fff;">E-mail</th>
                                    <th style="color: #fff;">Estado</th>
                                    <th class="text-right" style="color: #fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($workers as $row)
                                        <tr>
                                            <td style="display: none;">{{ $row->id }}</td>
                                            <td>{{ $row->payroll_type_document_identification->name }} <br>
                                                {{ $row->identification_number }}</td>
                                            <td><a
                                                    href="{{ route('workers.show', $row) }}">{{ $row->first_name . ' ' . $row->surname }}</a>
                                            </td>
                                            <td>{{ $row->email }}</td>
                                            <td>
                                                @if ($row->status == 'ACTIVO')
                                                    <span class="badge badge-success">{{ $row->status }}</span>
                                                @else
                                                    <span class="badge badge-danger">{{ $row->status }}</span>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                @can('workers.eliminar')
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['workers.destroy', $row], 'style' => 'display:inline', 'class' => 'form-delete']) !!}
                                                    {!! Form::button('<i class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-icon icon-left']) !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                                @can('workers.editar')
                                                    <a class="btn btn-warning btn-icon icon-left"
                                                        href="{{ route('workers.edit', $row->id) }}"><i
                                                            class="fas fa-edit"></i></a>

                                                    {!! Form::open(['method' => 'PUT', 'route' => ['workers.change_status', $row], 'style' => 'display:inline']) !!}

                                                    @if ($row->status == 'ACTIVO')
                                                        {!! Form::button('<i class="fas fa-ban"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-icon icon-left']) !!}
                                                    @else
                                                        {!! Form::button('<i class="fas fa-check-circle"></i>', ['type' => 'submit', 'class' => 'btn btn-success btn-icon icon-left']) !!}
                                                    @endif
                                                    {!! Form::close() !!}
                                                @endcan
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $workers->links() !!}
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
