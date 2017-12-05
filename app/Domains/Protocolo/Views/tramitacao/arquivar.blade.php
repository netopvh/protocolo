@extends('layout.backend.app')

@section('page-header')
    @component('layout.backend.components.header')
        @slot('title')
            Arquivar Documentos
        @endslot
    @endcomponent
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.tramitacao.movimentar') }}
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
                </div>
                <div class="panel-body">
                    <form action="{{ route('admin.tramitacao.doc.arquivar.store',['id' => $documento->id]) }}" id="form_documento"
                          class="form-validate-jquery" method="POST" autocomplete="off" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <fieldset>
                            <legend class="text-semibold">Informações do Documento</legend>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-bold">Número:</label>
                                        <input name="numero" type="text" value="{{ $documento->numero }}"
                                               class="form-control text-uppercase" disabled>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="text-bold">Ano:</label>
                                        <input type="text" class="form-control" value="{{ $documento->ano }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-bold">Data do Doc:</label>
                                        <input name="data_doc" type="text" class="form-control"
                                               value="{{ $documento->data_doc }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="text-bold">Assunto:</label>
                                        <input name="assunto" type="text" value="{{ $documento->assunto }}"
                                               class="form-control text-uppercase" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Local de Arquivamento:</label>
                                        <input type="text" name="local_arquiv" class="form-control text-uppercase">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="text-bold display-block">Despacho: </label>
                                        <textarea name="despacho" class="textarea" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id_documento" value="{{ $documento->id }}">
                        </fieldset>
                        <div class="text-right">
                            <a href="{{ route('admin.tramitacao') }}" class="btn btn-info legitRipple"><i
                                        class="icon-database-arrow"></i> Retornar</a>
                            <button type="submit" id="btn_tramitacao" class="btn btn-primary legitRipple">Arquivar
                                Documento <i
                                        class="icon-database-insert position-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop