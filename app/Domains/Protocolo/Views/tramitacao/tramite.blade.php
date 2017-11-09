@extends('layout.backend.app')

@section('page-header')
    @component('layout.backend.components.header')
        @slot('title')
            Trâmite do Documento
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
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="text-bold display-block">Número / Ano:</label>
                                {{ $documento->numero }}/{{ $documento->ano }}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="text-bold display-block">Data do Documento:</label>
                                {{ $documento->data_doc }}
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="text-bold display-block">Assunto:</label>
                                {{ $documento->assunto }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-body border-top-teal">
                                <ul class="list-feed">
                                    @foreach($documento->tramitacoes as $tramitacao)
                                        <li>
                                            <div class="text-muted">{{ $tramitacao->created_at->format('d/m/Y H:i') }}
                                                - {{ $tramitacao->created_at->diffForHumans() }}</div>
                                            <span class="text-bold">{{ $tramitacao->usuario->name }}
                                                ({{ $tramitacao->usuario->departamento->descricao }})</span>
                                            @if($documento->int_ext=='I' && $tramitacao->tipo_tram == 'S')
                                                Criou o Documento Nº {{ $documento->numero }} e enviou para o <span
                                                        class="text-bold">{{ $tramitacao->departamento_destino->descricao }}</span>
                                            @elseif($documento->int_ext=='I' && $tramitacao->tipo_tram == 'D')
                                                Devolveu o Documento Nº {{ $documento->numero }} para o Departamento <span
                                                        class="text-bold">{{ $tramitacao->departamento_destino->descricao }}</span>
                                            @elseif($documento->int_ext=='E' && $tramitacao->tipo_tram == 'D')
                                                Devolveu o Documento Nº {{ $documento->numero }} para o Departamento <span
                                                        class="text-bold">{{ $tramitacao->departamento_destino->descricao }}</span>
                                            @elseif($documento->int_ext=='E' && $tramitacao->tipo_tram=='C')
                                                {{ $tipos[$tramitacao->tipo_tram] }} o Documento
                                                Nº {{ $documento->numero }} para <span
                                                        class="text-bold">{{ $tramitacao->departamento_destino->descricao }}</span>
                                                protocolado por <span
                                                        class="text-bold">{{ $tramitacao->secretaria_origem->descricao }}</span>
                                                @if($documento->int_ext=='I')

                                                @endif
                                            @elseif($tramitacao->tipo_tram=='R')
                                                {{ $tipos[$tramitacao->tipo_tram] }} o Documento
                                                Nº {{ $documento->numero }}
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- /top aligned -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop