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
                    <h4>Bem vindo ao Sistema de Protocolo</h4>
                    <p>{{ $data }}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- /dashboard content -->
@stop