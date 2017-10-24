@extends('layout.backend.app')

@section('page-header')
@component('layout.backend.components.header')
    @slot('title')
        Servidores
    @endslot
@endcomponent
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.servidores.edit') }}
@stop

@push('scripts-after')
<script type="text/javascript">
    

</script>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title"><i class="icon-forward"></i> Alterar registro do servidor<a
                                class="heading-elements-toggle"><i class="icon-more"></i></a>
                    </h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ route('admin.servidores.update',['id'=>$servidor->id]) }}" id="formServidores" class="form-validate-jquery" method="POST" autocomplete="off">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <fieldset>
                            <legend class="text-semibold">Entre com as informações</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-bold">Nome Completo:</label>
                                        <input name="nome" value="{{ $servidor->nome }}" type="text" class="form-control text-uppercase" required autofocus>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="text-bold">CPF:</label>
                                        <input value="{{ $servidor->cpf }}" name="cpf" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="text-bold">Estado Civil:</label>
                                        <select id="estcivil" class="form-control" name="estcivil" required>
                                            <option value="S"{{ $servidor->estcivil=='S'?' selected':'' }}>Solteiro(a)</option>
                                            <option value="U"{{ $servidor->estcivil=='U'?' selected':'' }}>União Estável</option>
                                            <option value="C"{{ $servidor->estcivil=='C'?' selected':'' }}>Casado(a)</option>
                                            <option value="D"{{ $servidor->estcivil=='D'?' selected':'' }}>Divorciado(a)</option>
                                            <option value="V"{{ $servidor->estcivil=='V'?' selected':'' }}>Viúvo(a)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="text-bold">Matrícula:</label>
                                        <input value="{{ $servidor->matricula }}" name="matricula" type="number" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="nomeconjuge" class="form-group collapse">
                                        <label class="text-bold">Nome do Cônjuge:</label>
                                        <input type="text" value="{{ $servidor->nomeconj }}" class="form-control text-uppercase" name="nomeconj">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-bold">Nome do Pai:</label>
                                        <input value="{{ $servidor->pai }}" name="pai" type="text" class="form-control text-uppercase">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-bold">Nome da Mãe:</label>
                                        <input value="{{ $servidor->mae }}" name="mae" type="text" class="form-control text-uppercase" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="display-block text-bold">Servidor(a) á disposição de outro órgão?</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="cedido" value="S" class="styled"{{ trim($servidor->cedido)=='S'?' checked':'' }} required>
                                            Sim
                                        </label>

                                        <label class="radio-inline">
                                            <input type="radio" name="cedido" value="N" class="styled"{{ trim($servidor->cedido)=='N'?' checked':'' }}  required>
                                            Não
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-8 collapse" id="lotacaooriginal">
                                    <div class="form-group">
                                        <label class="text-bold">Secretaria de Origem:</label>
                                        <select data-placeholder="Selecione a secretaria..." name="sec_origem_id" class="select-search">
                                            <option></option>
                                            @foreach($secretarias as $secretaria)
                                                <option value="{{ $secretaria->id }}"{{ $servidor->sec_origem_id==$secretaria->id?'selected':'' }}>{{ $secretaria->descricao }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-bold">Secretaria Atual:</label>
                                        <select data-placeholder="Selecione a secretaria..." name="sec_atual_id" class="select-search" required>
                                            <option></option>
                                            @foreach($secretarias as $secretaria)
                                                <option value="{{ $secretaria->id }}"{{ $servidor->sec_atual_id==$secretaria->id?'selected':'' }}>{{ $secretaria->descricao }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-bold">Grau de Instrução:</label>
                                        <select data-placeholder="Selecione o grau de instrução..." id="idgrinst" name="instrucao_id" class="select" required>
                                            <option></option>
                                            @foreach($grausInstrucao as $grauInstrucao)
                                                <option value="{{ $grauInstrucao->id }}"{{ $servidor->instrucao_id==$grauInstrucao->id?'selected':'' }}>{{ $grauInstrucao->descricao }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div id="nmfaculdade" class="col-md-4 collapse">
                                    <div class="form-group">
                                       <label class="text-bold">Nome da Faculdade:</label> 
                                       <input name="nomefaculdade" value="{{ $servidor->nomefaculdade }}" type="text" class="form-control text-uppercase">
                                    </div>
                                </div>
                                <div id="nmcurso" class="col-md-4 collapse">
                                    <div class="form-group">
                                       <label class="text-bold">Nome do Curso:</label> 
                                       <input name="nomecurso" value="{{ $servidor->nomecurso }}" type="text" class="form-control text-uppercase">
                                    </div>
                                </div>
                                <div id="rgclasse" id="" class="col-md-4 collapse">
                                    <div class="form-group">
                                       <label class="text-bold">Registro Classe:</label> 
                                       <input name="registroclasse" value="{{ $servidor->registroclasse }}" type="text" class="form-control text-uppercase">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-bold">Tipo de Cargo: </label>
                                        <span class="glyphicon glyphicon-info-sign" data-html="true" data-popup="tooltip" data-placement="right" title="<b>DIREÇÃO</b>: Descrição Direção;<br><b>SUPERVISÃO</b>: Descrição Supervisão;<br><b>ASSESSORIA</b>: Descrição Assessoria." aria-hidden="true"></span>
                                        <select id="idtpc" data-placeholder="Selecione o tipo de cargo..." name="tipocargo_id" class="select" required>
                                            <option></option>
                                            @foreach($tipoCargos as $tipoCargo)
                                                <option value="{{ $tipoCargo->id }}"{{ $servidor->tipocargo_id==$tipoCargo->id?'selected':'' }}>{{ $tipoCargo->descricao }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-bold">Cargo Comissionado: </label>
                                        <select data-placeholder="Selecione o cargo..." name="comissionado_id" class="select" required>
                                            <option></option>
                                            @foreach($cargosComissionado as $cargoComissionado)
                                                <option value="{{ $cargoComissionado->id }}"{{ $servidor->comissionado_id==$cargoComissionado->id?'selected':'' }}>{{ $cargoComissionado->descricao }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="display-block text-bold">Cargo exclusivo em comissão?</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="exclusivo_comissao" value="S" class="styled" {{ trim($servidor->exclusivo_comissao)=='S'?' checked':'' }} required>
                                            Sim
                                        </label>

                                        <label class="radio-inline">
                                            <input type="radio" name="exclusivo_comissao" value="N" class="styled" {{ trim($servidor->exclusivo_comissao)=='N'?' checked':'' }} required>
                                            Não
                                        </label>
                                    </div>
                                </div>
                                <div id="nomenclaturacargo" class="col-md-6 collapse">
                                    <div class="form-group">
                                        <label class="text-bold">Cargo Efetivo: </label>
                                        <select data-placeholder="Selecione o cargo..." name="nomenclatura_id" class="select-search">
                                            <option></option>
                                            @foreach($nomenclaturaCargos as $nomenclaturaCargo)
                                                <option value="{{ $nomenclaturaCargo->id }}"{{ $servidor->nomenclatura_id==$nomenclaturaCargo->id?'selected':'' }}>{{ $nomenclaturaCargo->descricao }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>  
                            </div>
                            <div id="divdirecao" class="row collapse">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-bold">Nome do Órgão ou Unidade: </label>
                                        <input name="nomeorgunidade" value="{{ $servidor->nomeorgunidade }}" type="text" class="form-control text-uppercase">
                                    </div>
                                </div>
                            </div>
                            <div id="divsupervisao" class="row collapse">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="text-bold">Atividade ou serviço que sua equipe realiza: </label>
                                        <textarea name="nomeativsuperv"  class="form-control textarea">{{ $servidor->nomeativsuperv }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div id="divassessoria" class="row collapse">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-bold">Chefe Imediato: </label>
                                        <input name="nomeautoridade" value="{{ $servidor->nomeautoridade }}" type="text" class="form-control text-uppercase">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="text-bold">Descrição das atividades exercidas por você: </label>
                                        <textarea name="atividades" class="form-control textarea" required>{{ $servidor->atividades }}</textarea>
                                    </div>
                                </div>
                            </div> 
                        </fieldset>

                        <div class="text-right">
                            <a href="{{ route('admin.servidores') }}" class="btn btn-info legitRipple"><i class="icon-database-arrow"></i> Retornar</a>
                            <button type="submit" class="btn btn-primary legitRipple">Atualizar Registro <i
                                        class="icon-database-insert position-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop