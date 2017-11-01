@extends('layout.backend.app')

@section('page-header')
    @component('layout.backend.components.header')
        @slot('title')
            Documentos
        @endslot
    @endcomponent
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.documento.show') }}
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
                        <div class="col-md-2">
                            <table class="table table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th>Arquivos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($documento->documentos as $doc)
                                        <tr>
                                            <td>
                                                <button id="link{{ $doc->id }}" class="btn-link file" data-id="{{ $doc->id }}" data-url="{{ asset('storage/'.$doc->filename) }}">
                                                    <i class="icon-books"></i> Doc. {{ $loop->iteration }}
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-10 embed-responsive embed-responsive-16by9">
                            <iframe class="docs-show" src="" frameborder="0" width="100%" height="40%" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop