@extends('layouts.app')

@section('title')
Ralacionar Empresa y Usuarios
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Ralacionar Empresa y Usuarios</h3>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('company_has_user.index') }}">Empresa y sus Usuarios</a></div>
                <div class="breadcrumb-item">Ralacionar Empresa y Usuarios</div>
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

            {!! Form::open(['route' => 'company_has_user.store', 'method' => 'POST']) !!}
            
            <div class="row">
                <div class="col-lg-12">
                               
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="card-header">
                                <h5>Relacionar</h5>
                            </div>
                            <div class="card-block">
                              
                                <div class="row">
                                    <div class="col-sm-12 col-xl-6 m-b-30">
                                        <div class="form-group">
                                            {!! Html::decode(Form::label('company_id', 'Empresa<span class="text-danger">(*)</span>')) !!}
                                            {!! Form::select('company_id', $companies->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'company_id', 'placeholder' => '-- Seleccionar --']) !!}
                                            <div class="invalid-feedback">
                                                {{ $errors->first('company_id') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-xl-6 m-b-30">
                                        <div class="form-group">
                                            {!! Html::decode(Form::label('user_id', 'Usuario<span class="text-danger">(*)</span>')) !!}
                                            {!! Form::select('user_id', $users->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'user_id', 'placeholder' => '-- Seleccionar --']) !!}
                                            <div class="invalid-feedback">
                                                {{ $errors->first('user_id') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
           
            @section('scripts')
                <script>
                    $(document).ready(function() {
                        $('#company_id').select2();
                        $('#user_id').select2();
                    });
                </script>
            
            @endsection
            

            {!! Form::close() !!}
        </div>
    </section>
@endsection
