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
                        <div class="col-md-8">
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
                                            <option value="2015"{{ selected(date('Y'),'2015') }}>2015</option>
                                            <option value="2016"{{ selected(date('Y'),'2016') }}>2016</option>
                                            <option value="2017"{{ selected(date('Y'),'2017') }}>2017</option>
                                            <option value="2018"{{ selected(date('Y'),'2018') }}>2018</option>
                                            <option value="2019"{{ selected(date('Y'),'2019') }}>2019</option>
                                            <option value="2020"{{ selected(date('Y'),'2020') }}>2020</option>
                                            <option value="2021"{{ selected(date('Y'),'2021') }}>2021</option>
                                            <option value="2022"{{ selected(date('Y'),'2022') }}>2022</option>
                                            <option value="2023"{{ selected(date('Y'),'2023') }}>2023</option>
                                        </select>
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