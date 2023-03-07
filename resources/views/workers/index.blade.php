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

        <p class="section-lead">Los empleados que tienes activos son los que se incluirán al crear una nómina.
          </p>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            @can('workers.crear')
                                <a href="{{ route('workers.create') }}" class="btn btn-info btn-icon icon-left"><i
                                        class="fas fa-plus"></i> Nuevo Empleado</a>
                            @endcan


                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped mt-2">
                                    <thead style="background-color: #6777ef;">
                                        <th style="display: none;">Id</th>
                                        <th style="color: #fff;">Documento</th>
                                        <th style="color: #fff;">Nombre</th>
                                        <th style="color: #fff;">E-mail</th>
                                        <th style="color: #fff;">Estado</th>
                                        <th class="text-right" style="color: #fff;">Acciones</th>
                                    </thead>
                                    <tbody>
                                        @if (count($workers) <= 0)
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
                                                                Todos los registros existentes se mostraran aquí.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($workers as $row)
                                                <tr role="row" class="odd">
                                                    <td style="display: none;">{{ $row->id }}</td>
                                                    <td>{{ $row->payroll_type_document_identification->name }} <br>
                                                        {{ $row->identification_number }}</td>
                                                    <td><a
                                                            href="{{ route('workers.show', $row) }}">{{ $row->first_name . ' ' . $row->surname }}</a>
                                                    </td>
                                                    <td>{{ $row->email }}</td>
                                                    <td>
                                                        @if ($row->status == 'ACTIVO')
                                                            <div class="badge badge-success">{{ $row->status }}</div>
                                                        @else
                                                            <div class="badge badge-danger">{{ $row->status }}</div>
                                                        @endif
                                                    </td>
                                                    <td class="text-right">

                                                        <div class="btn-group dropleft" style="float:right;width:50px;">
                                                            <button
                                                                class="btn btn-sm btn-light  waves-light"
                                                                type="button" id="dropdown3" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-h"></i></button>
                                                            <div class="dropdown-menu dropleft">

                                                                @can('workers.eliminar')
                                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['workers.destroy', $row], 'style' => 'display:inline', 'class' => 'form-delete']) !!}
                                                                    {!! Form::button('<i class="fas fa-trash-alt"></i> Eliminar', ['type' => 'submit', 'class' => 'dropdown-item btn-link me-2']) !!}
                                                                    {!! Form::close() !!}
                                                                @endcan

                                                                @can('workers.editar')
                                                                    <a class="dropdown-item has-icon"
                                                                        href="{{ route('workers.edit', $row->id) }}"><i
                                                                            class="far fa-edit"></i> Modificar</a>

                                                                    {!! Form::open(['method' => 'PUT', 'route' => ['workers.change_status', $row], 'style' => 'display:inline']) !!}

                                                                    @if ($row->status == 'ACTIVO')
                                                                        {!! Form::button('<i class="fas fa-ban" style="color:#FF267B;"></i> Inactivar', ['type' => 'submit', 'class' => 'dropdown-item btn-link me-2']) !!}
                                                                    @else
                                                                        {!! Form::button('<i class="fas fa-check-circle" style="color:#47c363;"></i> Activar', ['type' => 'submit', 'class' => 'dropdown-item btn-link me-2']) !!}
                                                                    @endif
                                                                    {!! Form::close() !!}
                                                                @endcan

                                                            </div>
                                                            <!-- end of dropdown menu -->
                                                        </div>

                                                    </td>

                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
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
