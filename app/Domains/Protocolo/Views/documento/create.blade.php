@extends('layout.backend.app')

@section('page-header')
    @component('layout.backend.components.header')
        @slot('title')
            Documentos
        @endslot
    @endcomponent
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.documento.create') }}
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
                    <form action="{{ route('admin.documento.store') }}" id="form_documento" class="form-validate-jquery" method="POST" autocomplete="off" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <fieldset>
                            <legend class="text-semibold">Entre com as informações</legend>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-bold">Número:</label>
                                        <input name="numero" type="text" value="{{ old('numero') }}" class="form-control text-uppercase" required autofocus>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="text-bold">Ano:</label>
                                        <select class="select" name="ano">
                                            @foreach($years as $year)
                                                <option value="{{ $year }}"{{ selected(date('Y'),$year) }}>{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-bold">Data do Doc:</label>
                                        <input name="data_doc" type="text" class="form-control datepicker" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                            </div>
                            <div class="row">
                                <div id="orgsec" class="col-md-8 collapse">
                                    <div class="form-group">
                                        <label class="text-bold">Órgão/Secretaria:</label>
                                        <select class="select-search" name="id_secretaria">
                                            <option></option>
                                            @foreach($secretarias as $secretaria)
                                                <option value="{{ $secretaria->id }}">{{ $secretaria->descricao }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div id="setdep" class="col-md-8 collapse">
                                    <div class="form-group">
                                        <label class="text-bold">Setor/Departamento:</label>
                                        <select class="select-search" name="id_departamento">
                                            <option></option>
                                            @foreach($departamentos as $departamento)
                                                <option value="{{ $departamento->id }}">{{ $departamento->descricao }}</option>
                                            @endforeach
                                        </select>
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
                                            @foreach($tipo_documentos as $tipo_documento)
                                                <option value="{{ $tipo_documento->id }}">{{ $tipo_documento->descricao }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="text-bold display-block">Anexos: <span class="text-danger text-size-mini">*Permitido apenas arquivos .PDF|.DOC|.DOCX</span></label>
                                        <input type="file" name="documentos[]" class="file-styled-primary" multiple required>
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
                        </fieldset>

                        <div class="text-right">
                            <a href="{{ route('admin.documento') }}" class="btn btn-info legitRipple"><i class="icon-database-arrow"></i> Retornar</a>
                            <button type="submit" class="btn btn-primary legitRipple">Salvar Registro <i
                                        class="icon-database-insert position-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop