@extends('layout.backend.app')

@section('page-header')
    @component('layout.backend.components.header')
        @slot('title')
            Tramitação de Documentos
        @endslot
    @endcomponent
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.tramitacao') }}
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
                    <br>
                    <a href="{{ route('admin.tramitacao.create') }}" class="btn btn-primary btn-raised legitRipple"><i
                                class="icon-database-add"></i>
                        Cadastrar</a>
                </div>
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="tabbable">
                            <ul class="nav nav-tabs nav-tabs-highlight">
                                <li class="active"><a href="#highlighted-tab1" data-toggle="tab">Documentos no Setor</a></li>
                                <li><a href="#highlighted-tab2" data-toggle="tab">Documentos Pendentes de Recebimento</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="highlighted-tab1">
                                    <fieldset>
                                        <legend>Documentos</legend>
                                        <form method="POST" id="search-form" class="form-inline" role="form">
                                            <div class="form-group">
                                                <label for="name">Numero:</label>
                                                <input type="text" class="form-control" name="numero" id="numero">
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
                                            <div class="form-group">
                                                <label for="email">Tipo de Documento:</label>
                                                <select name="id_tipo_doc" id="id_tipo_doc" class="form-control">
                                                    <option value=""></option>
                                                    @foreach($tipo_documentos as $tipo_documento)
                                                        <option value="{{ $tipo_documento->id }}">{{ $tipo_documento->descricao }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Pesquisar</button>
                                        </form>
                                        <hr>
                                        <table id="tbl_documento" class="table table-framed table-bordered table-striped text-size-base" data-form="deleteForm">
                                            <thead>
                                            <tr>
                                                <th>Número</th>
                                                <th>Ano</th>
                                                <th>Assunto</th>
                                                <th>Tipo Documento</th>
                                                <th>Data Doc</th>
                                                <th class="text-center">Ações</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </fieldset>
                                </div>

                                <div class="tab-pane" id="highlighted-tab2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <fieldset>
                                                <legend>Documentos Pendentes</legend>
                                                <form method="POST" id="search-form-pend" class="form-inline" role="form">
                                                    <div class="form-group">
                                                        <label for="name">Numero:</label>
                                                        <input type="text" class="form-control" name="numero" id="numero">
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
                                                </form>
                                                <hr>
                                                <table id="tbl_doc_pendentes" class="table table-framed table-bordered table-striped text-size-base" data-form="deleteForm">
                                                    <thead>
                                                    <tr>
                                                        <th>Número</th>
                                                        <th>Ano</th>
                                                        <th>Assunto</th>
                                                        <th>Tipo Documento</th>
                                                        <th>Data Doc</th>
                                                        <th class="text-center">Ações</th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
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