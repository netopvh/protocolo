@extends('layout.backend.app')

@section('page-header')
@component('layout.backend.components.header')
    @slot('title')
        Usuários
    @endslot
@endcomponent
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.users.add') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title"><i class="icon-forward"></i> Cadastrar novo usuário<a
                                class="heading-elements-toggle"><i class="icon-more"></i></a>
                    </h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ route('admin.users.store') }}" class="form-validate-jquery" method="POST">
                        {{ csrf_field() }}
                        <fieldset>
                            <legend class="text-semibold">Entre com as informações</legend>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Nome Completo:</label>
                                        <input name="name" type="text" value="{{ old('name') }}" class="form-control text-uppercase" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Login / Matrícula:</label>
                                        <input name="username"  value="{{ old('username') }}" type="text" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>E-mail:</label>
                                        <input name="email" value="{{ old('email') }}" type="email" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Senha:</label>
                                        <input name="password" id="password" type="password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Repetir Senha:</label>
                                        <input name="repeat_password" type="password" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Perfil de Acesso:</label>
                                        <select name="role_id" data-placeholder="Selecione o perfil"
                                                class="select select2-hidden-accessible" tabindex="-1"
                                                aria-hidden="true" required>
                                            <option value="">Selecione o Perfil</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <div class="text-right">
                            <a href="{{ route('admin.users') }}" class="btn btn-info legitRipple"><i class="icon-database-arrow"></i> Retornar</a>
                            <button type="submit" class="btn btn-primary legitRipple">Salvar Registro <i
                                        class="icon-database-insert position-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop