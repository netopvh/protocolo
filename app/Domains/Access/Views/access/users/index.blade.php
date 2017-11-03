@extends('layout.backend.app')

@section('page-header')
    @component('layout.backend.components.header')
        @slot('title')
            Usuários
        @endslot
    @endcomponent
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.users') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                        </ul>
                    </div>
                    <br>
                    @permission('criar-usuario')
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-raised legitRipple"><i
                                class="icon-database-add"></i>
                        Cadastrar</a>
                    @endpermission
                </div>
                <div class="panel-body">
                    <form action="">
                        <fieldset>
                            <legend>Pesquisar Usuário</legend>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="col-lg-10">
                                        <div class="input-group">
												<span class="input-group-btn">
													<button class="btn btn-default btn-icon legitRipple"
                                                            type="button"><i class="icon-user"></i></button>
												</span>
                                            <input type="text" name="search" class="form-control text-uppercase upper"
                                                   placeholder="Digite o nome do usuário">
                                            <span class="input-group-btn">
													<button class="btn btn-default legitRipple"
                                                            type="submit">Pesquisar</button>
												</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-framed table-bordered table-striped text-size-base"
                           data-form="deleteForm">
                        <thead>
                        <tr>
                            <th onclick="return window.location.href='{{ route('admin.users',array_merge(request()->query(),['orderBy'=>'id'])) }}'" width="70">#</th>
                            <th onclick="return window.location.href='{{ route('admin.users',array_merge(request()->query(),['orderBy'=>'name'])) }}'">Nome Completo</th>
                            <th>Departamento/Setor</th>
                            <th>Perfil</th>
                            <th width="80" class="text-center">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($users))
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ is_null($user->id_departamento)?'Não Atribuído':$user->departamento->descricao }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            {{ $role->display_name }}
                                        @endforeach
                                    </td>
                                    <td>
                                        <ul class="icons-list">
                                            @permission('atualizar-usuario')
                                            <li><a href="{{ route('admin.users.edit',['id' => $user->id]) }}"><i
                                                            class="icon-pencil7"></i></a></li>
                                            @endpermission
                                            @permission('remover-usuario')
                                            <li>
                                                <form class="form-delete"
                                                      action="{{ route('admin.users.destroy',['id' => $user->id]) }}"
                                                      method="POST">
                                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button name="delete-modal" class="delete"
                                                            style="padding: 0 0 0 0;border: 0; background: transparent;"><i
                                                                class="icon-trash" style="padding-top: 2px;"></i></button>
                                                </form>
                                            </li>
                                            @endpermission
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center text-bold">Sem registros a serem exibidos</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="pull-right">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="confirm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Remoção de registro</h4>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja remover este registro?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" id="delete-btn">Remover</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
@stop