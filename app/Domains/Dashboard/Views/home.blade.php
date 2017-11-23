@extends('layout.backend.app')

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.home') }}
@stop

@section('content')
    <!-- Dashboard content -->
    <div class="row">
        <div class="col-lg-12">
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
                    <p class="pull-right">{{ ucfirst($data) }}</p>
                    <div class="row">
                        <div class="col-md-12">
                            <fieldset>
                                <legend>Documentos Pendentes de Recebimento</legend>
                                <table id="tbl_dashboard" class="table table-bordered table-condensed table-striped" data-form="tbDashboard">
                                    <thead>
                                        <tr>
                                            <th>Número/Ano</th>
                                            <th>Prioridade</th>
                                            <th>Tipo</th>
                                            <th>Encaminhado por</th>
                                            <th>Data</th>
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
    <!-- /dashboard content -->
@stop