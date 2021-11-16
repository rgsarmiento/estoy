@extends('layouts.app')

@section('title')
    Empresas
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Empresas</h3>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
                <div class="breadcrumb-item">Empresas</div>
            </div>
        </div>

        <div>
            @if (Session::has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            @can('companies.crear')
                                <a class="btn btn-info btn-icon icon-left" href="{{ route('companies.create') }}"><i
                                        class="fas fa-plus"></i> Nueva Empresa</a>
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
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mt-2">
                                    <thead style="background-color: #6777ef;">
                                        <th style="display: none;">Id</th>
                                        <th style="color: #fff;">NDI</th>
                                        <th style="color: #fff;">Nombre</th>
                                        <th style="color: #fff;">E-mail</th>
                                        <th class="text-right" style="color: #fff;">Acciones</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($datatable as $row)
                                            <tr>
                                                <td style="display: none;">{{ $row->id }}</td>
                                                <td>{{ $row->type_document_identification->name }} <br>
                                                    {{ $row->identification_number }}</td>
                                                <td><a href="{{ route('companies.show', $row) }}">{{ $row->name }}</a>
                                                    <br> <span style="font-size: .6em" class="badge badge-light">
                                                        {{ $row->api_token }} </span> </td>
                                                <td>{{ $row->email }}</td>
                                                <td class="text-right">
                                                    @can('companies.editar')
                                                        <a class="btn btn-warning btn-sm btn-icon icon-left"
                                                            href="{{ route('companies.edit', $row->id) }}"><i
                                                                class="fas fa-edit"></i></a>
                                                    @endcan
                                                    @can('companies.eliminar')
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['companies.destroy', $row->id], 'style' => 'display:inline']) !!}
                                                        {!! Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-danger btn-sm btn-icon icon-left']) !!}
                                                        {!! Form::close() !!}
                                                    @endcan
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination justify-content-end">
                                {!! $datatable->links() !!}
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

        $(document).ready(function() {
            $('#btn-delete').click(function() {
                delete_item(id);
            });
        });

        function delete_item(id) {

        }
    </script>

@endsection
