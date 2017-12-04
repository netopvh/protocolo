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
                            <form method="POST" id="filter-form" role="form" autocomplete="off">
                                <fieldset>
                                    <legend>Localizar Documento no Sistema</legend>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name">Numero:</label>
                                                <input type="text" class="form-control" name="numero" id="numero" autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="email">Ano:</label>
                                                <select name="ano" id="ano" class="form-control">
                                                    @foreach($dados['years'] as $year)
                                                        <option value="{{ $year }}"{{ selected(date('Y'),$year) }}>{{ $year }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="display-block">Procedência:</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="int_ext" value="I" class="styled">
                                                    Interno
                                                </label>

                                                <label class="radio-inline">
                                                    <input type="radio" name="int_ext" value="E" class="styled">
                                                    Externo
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="name">Assunto:</label>
                                                <input type="text" class="form-control upper" name="assunto" id="assunto">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary legitRipple"><i class="icon-search4"></i> Pesquisar</button>
                                                <a href="{{ route('admin.tramitacao') }}" class="btn btn-info legitRipple"><i class="icon-reply"></i> voltar</a>
                                            </div>
                                        </div>
                                    </div>
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
                            <div class="col-md-12">
                                <table class="table table-striped table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="90">Número/Ano</th>
                                            <th width="100">Tipo</th>
                                            <th>Assunto</th>
                                            <th width="150">Data Documento</th>
                                            <th width="50">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-content">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop