@extends('layout.backend.app')

@section('page-header')
    @component('layout.backend.components.header')
        @slot('title')
            Validação de Servidores
        @endslot
    @endcomponent
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.validacao') }}
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
                </div>
                <div class="panel-body">
                    <form method="POST" id="search-form" class="form-inline" role="form">
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" class="form-control upper" name="nome" id="nome" placeholder="Pesquisar nome">
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="validado" id="validado" class="form-control">
                                <option value="N">Não Validado</option>
                                <option value="S">Validado</option>
                                <option value="P">Pendente</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Pesquisar</button>
                    </form>
                </div>
                <div class="table-responsive">
                        <table id="tbl_validacao" class="table table-framed table-bordered table-striped text-size-base">
                            <thead>
                            <tr>
                                <th >Matrícula</th>
                                <th>Nome Completo</th>
                                <th>Lotação</th>
                                <th>Tipo</th>
                                <th>Validado</th>
                                <th class="text-center">Ações</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
            </div>
        </div>
    </div>
@stop