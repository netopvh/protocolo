@extends('layout.backend.app')

@section('page-header')
    @component('layout.backend.components.header')
        @slot('title')
            Perfis de Acesso
        @endslot
    @endcomponent
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.roles.edit') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title"><i class="icon-forward"></i> Editar Perfil<a
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
                    <form action="{{ route('admin.roles.update',['id' => $role->id]) }}" class="form-validate-jquery"
                          method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <fieldset>
                            <legend class="text-semibold">Atualize as informações</legend>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nome do Pefil:</label>
                                        <input name="display_name" type="text" value="{{ $role->display_name }}"
                                               class="form-control text-uppercase" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Definir Permissões:</label>
                                    @if($permissions->count())
                                    <select name="permissions[]" multiple="multiple" class="form-control listbox"
                                            required>
                                        @foreach($permissions as $perm)
                                            <option value="{{ $perm->id }}"{{ is_array(old('permissions')) ? (in_array($perm->id, old('permissions')) ? 'selected' : '') : (in_array($perm->id, $role->permissions->pluck('id')->all()) ? 'selected' : '') }}>{{ array_last_value($perm->display_name,' ') }} | {{ $perm->display_name }}</option>
                                        @endforeach
                                    </select>
                                    @else
                                        <p>Não existem permissões disponíveis.</p>
                                    @endif
                                </div>
                            </div>
                        </fieldset>

                        <div class="text-right">
                            <a href="{{ route('admin.roles') }}" class="btn btn-info legitRipple"><i
                                        class="icon-database-arrow"></i> Retornar</a>
                            <button type="submit" class="btn btn-primary legitRipple">Alterar Registro <i
                                        class="icon-database-insert position-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop