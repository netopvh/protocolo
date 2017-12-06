@extends('layout.backend.app')

@section('page-header')
    @component('layout.backend.components.header')
        @slot('title')
            Transformar Documento em Processo
        @endslot
    @endcomponent
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.processo.create') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
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
                    <form action="{{ route('admin.processo.store',['id' => $documento->id]) }}" class="form-validate-jquery" method="POST" autocomplete="off">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <fieldset>
                            <legend class="text-semibold">Entre com as informações</legend>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-bold">Número / Ano:</label>
                                        <input name="descricao" value="{{ $documento->numero }}/{{ $documento->ano }}" type="text" class="form-control text-uppercase" disabled>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label class="text-bold">Assunto:</label>
                                        <input type="text" value="{{ $documento->assunto }}" class="form-control" disabled="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-bold">Número do Processo:</label>
                                        <input type="text" class="form-control" name="num_processo" required autofocus>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <div class="text-right">
                            <a href="{{ route('admin.tramitacao') }}" class="btn btn-info legitRipple"><i class="icon-database-arrow"></i> Retornar</a>
                            <button type="submit" class="btn btn-primary legitRipple">Transformar em Processo <i
                                        class="icon-database-insert position-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop