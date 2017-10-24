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
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Arquivos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($documento->documentos as $doc)
                                        <tr>
                                            <td>
                                                <a id="link-{{ $loop->iteration }}" href="#" data-url="{{ asset('storage/'.$doc->filename) }}"><i class="icon-books"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-9 col-md-offset-1">
                            <a href="{{ asset('storage/'.$documento->documentos[0]->filename) }}" class="media"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop