@extends('layout.backend.app')

@section('page-header')
    @component('layout.backend.components.header')
        @slot('title')
            Documentos
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
                        <div class="col-md-5">
                            <a href="{{ url()->previous() }}" class="btn btn-info legitRipple"><i class="icon-database-arrow"></i> Retornar</a>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 embed-responsive embed-responsive-16by9">
                            <iframe class="docs-show" src="{{ asset('storage/'.$documento->path_doc) }}" frameborder="0" width="100%" height="40%" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop