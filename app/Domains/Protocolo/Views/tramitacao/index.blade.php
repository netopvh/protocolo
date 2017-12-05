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

@push('scripts-before')
    <script>
        CKEDITOR.replace('editor');
    </script>
@endpush

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
                    <a href="{{ route('admin.tramitacao.create') }}" class="btn btn-primary btn-raised legitRipple">
                        <i class="icon-database-add"></i>
                        Novo Protocolo
                    </a>
                    <a href="{{ route('admin.tramitacao.doc.consulta') }}" class="btn btn-primary btn-raised legitRipple">
                        <i class="icon-search4"></i>
                        Localizar Documento
                    </a>
                </div>
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="tabbable">
                            <ul class="nav nav-tabs nav-tabs-highlight">
                                <li class="active">
                                    <a href="#highlighted-tab1" data-toggle="tab">
                                        {{ in_admin_group()?'Documentos de Todos Setores':'Documentos no Setor' }}
                                        <span class="badge badge-success position-right" id="setor"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#highlighted-tab2" data-toggle="tab">
                                        {{ in_admin_group()?'Documentos á Receber no Sistema':'Documentos á Receber' }}
                                        <span class="badge badge-info position-right" id="pendente"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#highlighted-tab3" data-toggle="tab">
                                        {{ in_admin_group()?'Documentos Arquivados no Sistema':'Documentos Arquivados' }}
                                        <span class="badge badge-warning position-right" id="arquivado"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#highlighted-tab4" data-toggle="tab">
                                        {{ in_admin_group()?'Documentos Enviados no Sistema':'Documentos Enviados/Externos' }}
                                        <span class="badge badge-primary position-right" id="enviado"></span>
                                    </a>
                                </li>
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
                                        <table id="tbl_documento"
                                               class="table table-framed table-bordered table-striped text-size-base"
                                               data-form="tbSetor">
                                            <thead>
                                            <tr>
                                                <th>Número/Ano</th>
                                                <th>Assunto</th>
                                                <th>Tipo Documento</th>
                                                <th>Protocolado por</th>
                                                <th>Data Doc</th>
                                                <th class="text-center">Ações</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </fieldset>
                                </div>

                                <div class="tab-pane" id="highlighted-tab2">
                                    <fieldset>
                                        <legend>Documentos Pendentes</legend>
                                        <form method="POST" id="search-form-pend" class="form-inline" role="form">
                                            <div class="form-group">
                                                <label for="name">Numero:</label>
                                                <input type="text" class="form-control" name="numero"
                                                       id="numeroPendente">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Ano:</label>
                                                <select name="ano" id="anoPendente" class="form-control">
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
                                        <table id="tbl_doc_pendentes"
                                               class="table table-framed table-bordered table-striped text-size-base"
                                               data-form="tbPendente">
                                            <thead>
                                            <tr>
                                                <th>Número/Ano</th>
                                                <th>Assunto</th>
                                                <th>Tipo Documento</th>
                                                <th>Protocolado por</th>
                                                <th>Data Doc</th>
                                                <th class="text-center">Ações</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </fieldset>
                                </div>

                                <div class="tab-pane" id="highlighted-tab3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <fieldset>
                                                <legend>Documentos Arquivados</legend>
                                                <form method="POST" id="search-form-arquiv" class="form-inline"
                                                      role="form">
                                                    <div class="form-group">
                                                        <label for="name">Numero:</label>
                                                        <input type="text" class="form-control" name="numero"
                                                               id="numeroArquivado">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Ano:</label>
                                                        <select name="ano" id="anoArquivado" class="form-control">
                                                            <option value="2015"{{ selected(date('Y'),'2015') }}>2015
                                                            </option>
                                                            <option value="2016"{{ selected(date('Y'),'2016') }}>2016
                                                            </option>
                                                            <option value="2017"{{ selected(date('Y'),'2017') }}>2017
                                                            </option>
                                                            <option value="2018"{{ selected(date('Y'),'2018') }}>2018
                                                            </option>
                                                            <option value="2019"{{ selected(date('Y'),'2019') }}>2019
                                                            </option>
                                                            <option value="2020"{{ selected(date('Y'),'2020') }}>2020
                                                            </option>
                                                            <option value="2021"{{ selected(date('Y'),'2021') }}>2021
                                                            </option>
                                                            <option value="2022"{{ selected(date('Y'),'2022') }}>2022
                                                            </option>
                                                            <option value="2023"{{ selected(date('Y'),'2023') }}>2023
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                                                </form>
                                                <hr>
                                                <table id="tbl_doc_arquivado"
                                                       class="table table-framed table-bordered table-striped text-size-base">
                                                    <thead>
                                                    <tr>
                                                        <th>Número/Ano</th>
                                                        <th>Assunto</th>
                                                        <th>Tipo Documento</th>
                                                        <th>Protocolado por</th>
                                                        <th>Data Doc</th>
                                                        <th class="text-center">Ações</th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="highlighted-tab4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <fieldset>
                                                <legend>Documentos enviado para outros órgão</legend>
                                                <form method="POST" id="search-form-enviado" class="form-inline"
                                                      role="form">
                                                    <div class="form-group">
                                                        <label for="name">Numero:</label>
                                                        <input type="text" class="form-control" name="numero"
                                                               id="numeroEnviado">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Ano:</label>
                                                        <select name="ano" id="anoEnviado" class="form-control">
                                                            <option value="2015"{{ selected(date('Y'),'2015') }}>2015
                                                            </option>
                                                            <option value="2016"{{ selected(date('Y'),'2016') }}>2016
                                                            </option>
                                                            <option value="2017"{{ selected(date('Y'),'2017') }}>2017
                                                            </option>
                                                            <option value="2018"{{ selected(date('Y'),'2018') }}>2018
                                                            </option>
                                                            <option value="2019"{{ selected(date('Y'),'2019') }}>2019
                                                            </option>
                                                            <option value="2020"{{ selected(date('Y'),'2020') }}>2020
                                                            </option>
                                                            <option value="2021"{{ selected(date('Y'),'2021') }}>2021
                                                            </option>
                                                            <option value="2022"{{ selected(date('Y'),'2022') }}>2022
                                                            </option>
                                                            <option value="2023"{{ selected(date('Y'),'2023') }}>2023
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                                                </form>
                                                <hr>
                                                <table id="tbl_doc_enviado"
                                                       class="table table-framed table-bordered table-striped text-size-base">
                                                    <thead>
                                                    <tr>
                                                        <th>Número/Ano</th>
                                                        <th>Assunto</th>
                                                        <th>Tipo Documento</th>
                                                        <th>Enviado para</th>
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
    <div class="modal" id="recebimento">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Recebimento de documentos</h4>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja receber este documento?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" id="confirm-recebe">Confirmar</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="devolucao">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Devolução de Documentos</h4>
                </div>
                <div class="modal-body">
                    <label class="text-bold display-block">Despacho: </label>
                    <textarea name="editor" id="editor" class="editor" cols="30" rows="10" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" id="confirm-devolucao">Confirmar</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
@stop