@extends('layout.backend.app')

@section('page-header')
    @component('layout.backend.components.header')
        @slot('title')
            Servidores
        @endslot
    @endcomponent
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.servidores.show') }}
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="display-block">Nome:</label>
                                <span class="text-bold">{{ $servidor->nome }}</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="display-block">CPF:</label>
                                <span class="text-bold">{{ mask($servidor->cpf,'###.###.###-##') }}</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="display-block">Estado Civil:</label>
                                <span class="text-bold">{{ array_search($servidor->estcivil,$estcivil) }}</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="display-block">Matrícula:</label>
                                <span class="text-bold">{{ $servidor->matricula }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="display-block">Nome do Pai:</label>
                                <span class="text-bold">{{ $servidor->pai }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="display-block">Nome da Mãe:</label>
                                <span class="text-bold">{{ $servidor->mae }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="display-block">Á disposição de outro órgão?</label>
                                <span class="text-bold">{{ trim($servidor->cedido)=='S'?'SIM':'NÃO' }}</span>
                            </div>
                        </div>
                        @if(trim($servidor->cedido)=='S')
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="display-block">Secretaria de Origem:</label>
                                <span class="text-bold">{{ get_sec($servidor->sec_origem_id) }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="display-block">Secretaria Atual:</label>
                                <span class="text-bold">{{ $servidor->secretaria->descricao }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="display-block">Grau de Instrucão:</label>
                                <span class="text-bold">{{ $servidor->grauinstrucao->descricao }}</span>
                            </div>
                        </div>
                    </div>
                    @if($servidor->instrucao_id >= 7)
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="display-block">Nome da Faculdade:</label>
                                <span class="text-bold">{{ $servidor->nomefaculdade }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="display-block">Nome do Curso:</label>
                                <span class="text-bold">{{ $servidor->nomecurso }}</span>
                            </div>
                        </div>
                        @if($servidor->instrucao_id > 7)
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="display-block">Registro da Classe:</label>
                                <span class="text-bold">{{ $servidor->registroclasse }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="display-block">Tipo de Cargo:</label>
                                <span class="text-bold">{{ $servidor->tipocargo->descricao }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="display-block">Cargo Comissionado:</label>
                                <span class="text-bold">{{ $servidor->cargocomissionado->descricao }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="display-block">Cargo exclusivo em comissão?</label>
                                <span class="text-bold">{{ trim($servidor->exclusivo_comissao)=='S'?'SIM':'NÃO' }}</span>
                            </div>
                        </div>
                        @if(trim($servidor->exclusivo_comissao)=='N')
                        <div class="col-md-10">
                            <div class="form-group">
                                <label class="display-block">Cargo Efetivo:</label>
                                <span class="text-bold">{{ $servidor->nomenclaturacargo->descricao }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                    @if($servidor->tipocargo_id==1)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="display-block">Órgão/Unidade:</label>
                                <span class="text-bold">{{ $servidor->nomeorgunidade }}</span>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($servidor->tipocargo_id==3)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="display-block">Chefe Imediato:</label>
                                <span class="text-bold">{{ $servidor->nomeautoridade }}</span>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($servidor->tipocargo_id==2)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="display-block">Descrição das Atividades de Supervisão:</label>
                                <div class="well">
                                    {!! $servidor->nomeativsuperv !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="display-block">Atividades do Servidor:</label>
                                <div class="well">
                                    {!! $servidor->atividades !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop