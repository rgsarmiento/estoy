@extends('layouts.app')

@section('title')
    Empleados
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Actualizar Empleado</h3>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('workers.index') }}">Empleados</a></div>
                <div class="breadcrumb-item">Actualizar Empleado</div>
              </div>
        </div>
        <div class="section-body">

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show p-0" role="alert">
                <strong>¡Revisar los campos!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

            {!! Form::model($worker, ['method' => 'PUT','route' => ['workers.update', $worker->id]]) !!}
            @include('workers._form')
            {!! Form::close() !!}
        </div>
    </section>
@endsection
