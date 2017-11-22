@extends('layout.backend.app')

@section('page-header')
    @component('layout.backend.components.header')
        @slot('title')
            Trâmite do Documento
        @endslot
    @endcomponent
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.tramitacao.doc.show') }}
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
                        <div class="col-md-10">
                            <form method="POST" id="filter-form" class="form-inline" role="form">
                                <fieldset>
                                    <legend>Localizar Documento no Sistema</legend>
                                    <div class="form-group">
                                        <label for="name">Numero:</label>
                                        <input type="text" class="form-control" name="numero" id="numero" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Ano:</label>
                                        <select name="ano" id="ano" class="form-control">
                                            @foreach($dados['years'] as $year)
                                                <option value="{{ $year }}"{{ selected(date('Y'),$year) }}>{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Procedência:</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="int_ext" value="I" class="styled" required>
                                            Interno
                                        </label>

                                        <label class="radio-inline">
                                            <input type="radio" name="int_ext" value="E" class="styled" required>
                                            Externo
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <br>
                    <span id="ajaxResponse" class="alert alert-warning collapse">
                        Nenhum registro foi localizado!
                    </span>
                    <div id="consulta" class="collapse">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="text-bold display-block">Número / Ano:</label>
                                    <input name="numero_ano" type="text" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="text-bold display-block">Data do Documento:</label>
                                    <input name="data_doc" type="text" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="text-bold display-block">Assunto:</label>
                                    <input name="assunto" type="text" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="text-bold display-block">Procedência:</label>
                                    <input name="procedencia" type="text" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <dif class="form-group">
                                    <label class="text-bold display-block">Tipo de Documento:</label>
                                    <input type="text" name="tipo_doc" class="form-control" disabled>
                                </dif>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="panel panel-body border-top-teal">
                                    <ul class="list-feed media-list">
                                        <li class="media">
                                            <div class="media-body">

                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop