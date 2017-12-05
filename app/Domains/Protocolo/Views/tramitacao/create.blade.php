@extends('layout.backend.app')

@section('page-header')
    @component('layout.backend.components.header')
        @slot('title')
            Protocolar Documentos
        @endslot
    @endcomponent
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.tramitacao.create') }}
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
                    <form action="{{ route('admin.tramitacao.store') }}" id="form_documento" class="form-validate-jquery" method="POST" autocomplete="off" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <fieldset>
                            <legend class="text-semibold">Entre com as informações</legend>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="text-bold">Número:</label>
                                        <input name="numero" type="text" value="{{ old('numero') }}" class="form-control text-uppercase" required autofocus>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="text-bold">Ano:</label>
                                        <select class="select" name="ano">
                                            @foreach($dados['years'] as $year)
                                                <option value="{{ $year }}"{{ selected(date('Y'),$year) }}>{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="text-bold">Data do Doc:</label>
                                        <input name="data_doc" type="text" class="form-control datepicker" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-bold display-block">Procedência:</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="int_ext" value="I" class="styled" required>
                                            Interno
                                        </label>

                                        <label class="radio-inline">
                                            <input type="radio" name="int_ext" value="E" class="styled" required>
                                            Externo
                                        </label>
                                    </div>
                                </div>
                                <div id="tipodoc" class="col-md-3 collapse">
                                    <div class="form-group">
                                        <label class="text-bold display-block">Tipo:</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="tipo_tram" value="C" class="styled" required>
                                            Entrada
                                        </label>

                                        <label class="radio-inline">
                                            <input type="radio" name="tipo_tram" value="O" class="styled" required>
                                            Saída
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="text-bold">Assunto:</label>
                                        <input name="assunto" type="text" value="{{ old('assunto') }}" class="form-control text-uppercase" required>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="text-bold">Tipo de Documento:</label>
                                        <select name="id_tipo_doc" class="select-search" required>
                                            <option></option>
                                            @foreach($dados['tipo_docs'] as $tipo_documento)
                                                <option value="{{ $tipo_documento['id'] }}">{{ $tipo_documento['descricao'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div id="orgsec" class="col-md-6 collapse">
                                    <div class="form-group">
                                        <label class="text-bold">Órgão/Secretaria:</label>
                                        <select class="select-search" name="id_secretaria">
                                            <option></option>
                                            @foreach($dados['secretarias'] as $secretaria)
                                                <option value="{{ $secretaria['id'] }}">{{ $secretaria['descricao'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div id="setdep" class="col-md-6 collapse">
                                    <div class="form-group">
                                        <label class="text-bold">Setor/Departamento:</label>
                                        <select class="select-search" name="id_departamento">
                                            <option></option>
                                            @foreach($dados['departamentos'] as $departamento)
                                                <option value="{{ $departamento['id'] }}">{{ $departamento['descricao'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row collapse" id="seclist">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Secretarias:</label>
                                        <select name="secretarias[]" multiple="multiple" class="form-control listbox-sec">
                                            @foreach($dados['secretarias'] as $secretaria)
                                                <option value="{{ $secretaria['id'] }}">{{ $secretaria['descricao'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-bold">Prioridade:</label>
                                        <select name="prioridade" class="select">
                                            <option value="3">ALTA</option>
                                            <option value="2">MÉDIA</option>
                                            <option value="1" selected>BAIXA</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="text-bold display-block">Anexos: <span class="text-danger text-size-mini">*Permitido apenas arquivos .PDF|.DOC|.DOCX</span></label>
                                        <input type="file" name="documento" class="file-styled-primary" multiple required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="text-bold display-block">Descrição (Objeto): </label>
                                        <textarea name="despacho" class="textarea" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <div class="text-right">
                            <a href="{{ route('admin.tramitacao') }}" class="btn btn-info legitRipple"><i class="icon-database-arrow"></i> Retornar</a>
                            <button type="submit" id="btn_tramitacao" class="btn btn-primary legitRipple">Salvar Registro <i
                                        class="icon-database-insert position-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop