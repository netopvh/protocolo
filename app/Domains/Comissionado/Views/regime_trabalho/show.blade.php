@extends('layout.backend.app')

@section('page-header')
    @component('layout.backend.components.header')
        @slot('title')
            Regime de Trabalho
        @endslot
    @endcomponent
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.regime.show') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
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
                        <div class="col-md-12">
                            <label class="display-block">Descrição:</label>
                            <span class="text-bold">{{ $regimeTrab->descricao }}</span>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <fieldset>
                                <legend>Servidores Vinculados</legend>
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <th width="120">Matrícula</th>
                                            <th>Nome</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @if(count($regimeTrab->servidores))
                                            @foreach($regimeTrab->servidores as $servidor)
                                                <tr>
                                                    <td>{{  $servidor->matricula }}</td>
                                                    <td>{{  $servidor->nome }}</td>
                                                </tr>
                                            @endforeach
                                       @else
                                            <tr>
                                                <td colspan="2" class="text-center text-bold">Sem registros a serem exibidos</td>
                                            </tr> 
                                       @endif
                                    </tbody>
                                </table>
                            </fieldset>
                            <div class="text-right">
                                <a href="{{ route('admin.regime') }}" class="btn btn-info legitRipple"><i class="icon-database-arrow"></i> Retornar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop