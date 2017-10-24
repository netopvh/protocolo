@extends('layout.backend.app')

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.roles') }}
@stop

@section('page-header')
    @component('layout.backend.components.header')
        @slot('title')
            Perfis de Acesso
        @endslot
    @endcomponent
@stop

@section('content')
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
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                        </ul>
                    </div>
                    <br>
                    @permission('criar-perfil')
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-raised legitRipple"><i
                                class="icon-database-add"></i>
                        Cadastrar</a>
                    @endpermission
                </div>
                <div class="table-responsive">
                    <table class="table table-framed table-bordered table-striped text-size-base"
                           data-form="deleteForm">
                        <thead>
                        <tr>
                            <th width="70">#</th>
                            <th>Nome do Perfil</th>
                            <th width="80" class="text-center">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->display_name }}</td>
                                <td>
                                    <ul class="icons-list">
                                        @permission('atualizar-perfil')
                                        <li><a href="{{ route('admin.roles.edit',['id' => $role->id]) }}"><i
                                                        class="icon-pencil7"></i></a></li>
                                        @endpermission
                                        @permission('remover-perfil')
                                        <li>
                                            <form class="form-delete"
                                                  action="{{ route('admin.roles.destroy',['id' => $role->id]) }}"
                                                  method="POST">
                                                <input type="hidden" name="id" value="{{ $role->id }}">
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop