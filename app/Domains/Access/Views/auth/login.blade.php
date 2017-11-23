@extends('layout.backend.app')

@section('styles')
    <style type="text/css">
        body{
            background: url('backend/images/bg/{{ rand(0,15) }}.jpg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <!-- Simple login form -->
            <form action="{{ route('login') }}" class="form-validate-jquery" method="POST">
                {{ csrf_field() }}
                <div class="panel panel-body login-form">
                    <div class="text-center">
                        <div class="icon-object border-slate-300 text-slate-300"><i class="icon-pen-minus"></i></div>
                        <h5 class="content-group">Sistema de Protocolo
                            <small class="display-block">Entre com sua credenciais</small>
                        </h5>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <input type="text" class="form-control" name="username" placeholder="Matrícula"
                               value="{{ old('username') }}" required autofocus>
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                        @if ($errors->has('username'))
                            <span class="help-block text-danger">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <input type="password" name="password" class="form-control" placeholder="Senha">
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                        @if ($errors->has('password'))
                            <span class="help-block text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn bg-pink-400 btn-block">Acessar <i
                                    class="icon-circle-right2 position-right"></i></button>
                    </div>
                </div>
            </form>
            <!-- /simple login form -->
        </div>
    </div>
@stop