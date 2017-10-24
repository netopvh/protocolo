@extends('layout.backend.app')

@section('page-header')
    @component('layout.backend.components.header')
        @slot('title')
            Secretarias
        @endslot
    @endcomponent
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.secretarias') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                        </ul>
                    </div>
                    <br>
                    <a href="{{ route('admin.secretarias.create') }}" class="btn btn-primary btn-raised legitRipple"><i
                                class="icon-database-add"></i>
                        Cadastrar</a>
                </div>
                <div class="panel-body">
                    <form action="">
                        <fieldset>
                            <legend>Localizar Secretaria</legend>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-lg-10">
                                        <div class="input-group">
												<span class="input-group-btn">
													<button class="btn btn-default btn-icon legitRipple"
                                                            type="button"><i class="icon-user"></i></button>
												</span>
                                            <input type="text" name="search" class="form-control text-uppercase upper"
                                                   placeholder="Digite o nome da secretaria">
                                            <span class="input-group-btn">
													<button class="btn bg-pink-700 legitRipple"
                                                            type="submit">Pesquisar</button>
												</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <table class="table table-framed table-bordered table-striped text-size-base"
                       data-form="deleteForm">
                    <thead>
                    <tr>
                        <th width="70">#</th>
                        <th>Descrição</th>
                        <th width="80" class="text-center">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($secretarias))
                        @foreach($secretarias as $secretaria)
                            <tr>
                                <td>{{ $secretaria->id }}</td>
                                <td>{{ $secretaria->descricao }}</td>
                                <td>
                                    <ul class="icons-list">
                                        <li><a href="{{ route('admin.secretarias.edit',['id' => $secretaria->id]) }}"
                                               data-popup="tooltip" title="Editar" data-placement="bottom"><i
                                                        class="icon-pencil7"></i></a>
                                        </li>
                                        <li>
                                            <form class="form-delete"
                                                  action="{{ route('admin.secretarias.destroy',['id'=>$secretaria->id]) }}"
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
                        {{ $secretarias->links() }}
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