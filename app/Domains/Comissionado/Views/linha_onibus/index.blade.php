@extends('layout.backend.app')

@section('page-header')
    @component('layout.backend.components.header')
        @slot('title')
            Linhas de Ônibus
        @endslot
    @endcomponent
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.linhas') }}
@stop

@section('content')
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
                    @permission('criar-linha-onibus')
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-raised legitRipple"><i
                                class="icon-database-add"></i>
                        Cadastrar</a>
                    @endpermission
                </div>
                <div class="table-responsive">
                    <table class="table table-framed table-bordered table-striped text-size-base" data-form="deleteForm">
                        <thead>
                        <tr>
                            <th width="70">#</th>
                            <th>Nome Completo</th>
                            <th width="80" class="text-center">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($linha_onibus))
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <ul class="icons-list">
                                        <li><a href=""><i
                                                        class="icon-pencil7"></i></a></li>
                                        <li>
                                            <form class="form-delete"
                                                  action=""
                                                  method="POST">
                                                <input type="hidden" name="id" value="">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button name="delete-modal" class="delete"
                                                        style="padding: 0 0 0 0;border: 0; background: transparent;"><i
                                                            class="icon-trash" style="padding-top: 2px;"></i></button>
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="3" class="text-center text-bold">Sem registros a serem exibidos</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
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