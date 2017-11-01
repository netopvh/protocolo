@extends('layout.backend.app')

@section('page-header')
    @component('layout.backend.components.header')
        @slot('title')
            Atualização de Usuário
        @endslot
    @endcomponent
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.home') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title"><i class="icon-forward"></i> Atualização de Informações do Sistema<a
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
                    <form action="{{ route('admin.users.departamento.update',['id' => auth()->user()->id]) }}" class="form-validate-jquery" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <fieldset>
                            <legend class="text-semibold">Atenção: é necessário informar o setor onde você está lotado.</legend>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="text-bold">Departamento/Setor:</label>
                                        <select name="id_departamento" data-placeholder="Selecione o Departamento"
                                                class="select-search" tabindex="-1"
                                                aria-hidden="true" required>
                                            <option value=""></option>
                                            @foreach($departamentos as $departamento)
                                                <option value="{{ $departamento->id }}">{{ $departamento->descricao }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <div class="text-right">
                            <a href="{{ route('admin.home') }}" class="btn btn-info legitRipple"><i class="icon-database-arrow"></i> Retornar</a>
                            <button type="submit" class="btn btn-primary legitRipple">Atualizar Registro <i
                                        class="icon-database-insert position-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop