@extends('layout.backend.app')

@section('page-header')
    @component('layout.backend.components.header')
        @slot('title')
            Grau de Instrução
        @endslot
    @endcomponent
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.instrucao') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                        </ul>
                    </div>
                    <br>
                    @permission('criar-grau-instrucao')
                    <a href="{{ route('admin.instrucao.create') }}" class="btn btn-primary btn-raised legitRipple"><i
                                class="icon-database-add"></i>
                        Cadastrar</a>
                    @endpermission
                </div>
                <table class="table table-framed table-bordered table-striped text-size-base" data-form="deleteForm">
                        <thead>
                        <tr>
                            <th width="70">#</th>
                            <th>Descrição</th>
                            <th width="104" class="text-center">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($grauInstrucao))
                            @foreach($grauInstrucao as $instrucao)
                                <tr>
                                    <td>{{ $instrucao->id }}</td>
                                    <td>{{ $instrucao->descricao }}</td>
                                    <td>
                                        <ul class="icons-list">
                                            @permission('ver-grau-instrucao')
                                            <li>
                                                <a href="{{ route('admin.instrucao.show',['id' => $instrucao->id]) }}"
                                               data-popup="tooltip" title="Visualizar" data-placement="bottom"><i
                                                        class="icon-eye"></i>
                                                </a>
                                            </li>
                                            @endpermission
                                            @permission('atualizar-grau-instrucao')
                                            <li>
                                                <a href="{{ route('admin.instrucao.edit',['id' => $instrucao->id]) }}"
                                               data-popup="tooltip" title="Editar" data-placement="bottom"><i
                                                        class="icon-pencil7"></i>
                                                </a>
                                            </li>
                                            @endpermission
                                            @permission('remover-grau-instrucao')
                                            <li>
                                                <form class="form-delete"
                                                      action="{{ route('admin.instrucao.destroy',['id'=>$instrucao->id]) }}"
                                                      method="POST">
                                                    <input type="hidden" name="id" value="">
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
                                <td colspan="3" class="text-center text-bold">Sem registros a serem exibidos</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="panel-body">
                        <div class="pull-right">
                            {{ $grauInstrucao->links() }}
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