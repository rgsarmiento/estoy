@extends('layouts.app')

@section('title')
    Empleados
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Crear Empleado</h3>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="home">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('workers.index') }}">Empleados</a></div>
                <div class="breadcrumb-item">Crear Empleado</div>
              </div>
        </div>
        <div class="section-body">

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


            {!! Form::open(['route' => 'workers.store', 'method' => 'POST']) !!}
            @include('workers._form')
            {!! Form::close() !!}
        </div>
    </section>
@endsection
