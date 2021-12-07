@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Usuarios</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Dashboard Content</h3>

                            @can('usuarios.crear')
                                <a class="btn btn-info" href="{{ route('usuarios.create') }}">Nuevo</a>
                            @endcan

                            <div class="table-responsive">
                                <table class="table table-striped mt-2">
                                    <thead style="background-color: #6777ef;">
                                        <th style="display: none;">Id</th>
                                        <th style="color: #fff;">Nombre</th>
                                        <th style="color: #fff;">E-mail</th>
                                        <th style="color: #fff;">Rol</th>
                                        <th class="text-right" style="color: #fff;">Acciones</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($usuarios as $usuario)
                                            <tr>
                                                <td style="display: none;">{{ $usuario->id }}</td>
                                                <td>
                                                    {{ $usuario->name }}                                                  

                                                </td>
                                                <td>{{ $usuario->email }}</td>
                                                <td>
                                                    @if (!empty($usuario->getRoleNames()))
                                                        @foreach ($usuario->getRoleNames() as $rolName)
                                                            <h5><span class="badge badge-dark">{{ $rolName }}</span>
                                                            </h5>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    @can('usuarios.editar')
                                                        <a class="btn btn-info"
                                                            href="{{ route('usuarios.edit', $usuario->id) }}">Editar</a>
                                                    @endcan
                                                    @can('usuarios.eliminar')
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['usuarios.destroy', $usuario->id], 'style' => 'display:inline']) !!}
                                                        {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                                        {!! Form::close() !!}
                                                    @endcan
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination justify-content-end">
                                    {!! $usuarios->links() !!}
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
