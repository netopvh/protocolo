@extends('layout.backend.app')

@section('page-header')
    @component('layout.backend.components.header')
        @slot('title')
            Regime de Trabalho
        @endslot
    @endcomponent
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.regime') }}
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
                    @permission('criar-regime-trabalho')
                    <a href="{{ route('admin.regime.create') }}" class="btn btn-primary btn-raised legitRipple"><i
                                class="icon-database-add"></i>
                        Cadastrar</a>
                    @endpermission
                </div>
                <table class="table table-framed table-bordered table-striped text-size-base"
                       data-form="deleteForm">
                    <thead>
                    <tr>
                        <th width="70">#</th>
                        <th>Descrição</th>
                        <th width="104" class="text-center">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($regimeTrab))
                        @foreach($regimeTrab as $regime)
                            <tr>
                                <td>{{ $regime->id }}</td>
                                <td>{{ $regime->descricao }}</td>
                                <td>
                                    <ul class="icons-list">
                                        @permission('ver-regime-trabalho')
                                        <li><a href="{{ route('admin.regime.show',['id' => $regime->id]) }}"
                                               data-popup="tooltip" title="Visualizar" data-placement="bottom"><i
                                                        class="icon-eye"></i></a>
                                        <li>
                                        @endpermission
                                        @permission('atualizar-regime-trabalho')
                                        <li><a href="{{ route('admin.regime.edit',['id' => $regime->id]) }}"
                                               data-popup="tooltip" title="Editar" data-placement="bottom"><i
                                                        class="icon-pencil7"></i></a>
                                        </li>
                                        @endpermission
                                        @permission('remover-regime-trabalho')
                                        <li>
                                            <form class="form-delete"
                                                  action="{{ route('admin.regime.destroy',['id'=>$regime->id]) }}"
                                                  method="POST">
                                                <input type="hidden" name="id" value="">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button name="delete-modal" data-popup="tooltip" title="Remover" data-placement="bottom" class="delete"
                                                        style="padding: 0 0 0 0;border: 0; background: transparent;">
                                                    <i
                                                            class="icon-trash" style="padding-top: 2px;"></i>
                                                </button>
                                            </form>
                                        </li>
                                        @endpermission
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="text-center text-bold">Sem registros a serem exibidos</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                    <div class="panel-body">
                        <div class="pull-right">
                            {{ $regimeTrab->links() }}
                        </div>
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