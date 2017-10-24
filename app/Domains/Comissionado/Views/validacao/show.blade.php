@extends('layout.backend.app')

@section('page-header')
    @component('layout.backend.components.header')
        @slot('title')
            Validar Servidor
        @endslot
    @endcomponent
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.validacao.show') }}
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
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="display-block">Nome do Servidor:</label>
                                <span class="text-bold">{{ $servidor->nome }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="display-block">Matrícula:</label>
                                <span class="text-bold">{{ $servidor->matricula }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="display-block">Cargo Comissionado:</label>
                                <span class="text-bold">{{ $servidor->cargocomissionado->descricao }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="display-block">Tipo de Cargo:</label>
                                <span class="text-bold">{{ $servidor->tipocargo->descricao }}</span>
                            </div>
                        </div>
                        @if($servidor->tipocargo_id == 1)
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="display-block">Organização / Unidade:</label>
                                    <span class="text-bold">{{ $servidor->nomeorgunidade }}</span>
                                </div>
                            </div>
                        @elseif(($servidor->tipocargo_id == 3))
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="display-block">Chefe Imediato:</label>
                                    <span class="text-bold">{{ $servidor->nomeautoridade }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if($servidor->tipocargo_id == 2)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="display-block">Descricão das Atividades de Supervisão:</label>
                                    <textarea class="form-control textarea">{{ $servidor->nomeativsuperv }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="display-block">Atividades do Servidor:</label>
                                <textarea class="form-control textarea">{{ $servidor->atividades }}</textarea>
                            </div>
                        </div>
                    </div> 

                    <div class="text-right">

                        <form id="formValidacao" class="form-valida" action="{{ route('admin.validacao.update',['id'=>$servidor->id]) }}" method="POST">
                            <a href="{{ route('admin.validacao') }}" class="btn btn-info legitRipple">
                                <i class="icon-database-arrow"></i> Retornar
                            </a>
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <input type="hidden" id="validado" name="validado" value="">
                            <input type="hidden" name="idvalidador" value="{{ auth()->user()->id }}">
                            <button type="submit" id="nao-valida" class="btn btn-danger legitRipple">
                                <i class="icon-database-time2 position-right"></i> não validar
                            </button>
                            <button type="submit" id="valida" class="btn btn-primary legitRipple">
                                validar <i class="icon-database-insert position-right"></i>
                            </button>
                        </form>
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
                    <h4 class="modal-title">Validação de Servidor</h4>
                </div>
                <div class="modal-body">
                    <p>Deseja prosseguir com esta operação?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" id="prosseguir-btn">Prosseguir</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
@stop