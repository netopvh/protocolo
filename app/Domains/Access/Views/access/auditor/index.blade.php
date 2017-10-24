@extends('layout.backend.app')

@section('page-header')
    @component('layout.backend.components.header')
        @slot('title')
            Auditoria e Logs
        @endslot
    @endcomponent
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.auditor') }}
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
                    <form action="">
                        <fieldset>
                            <legend>Pesquisar Registro</legend>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="col-lg-10">
                                        <div class="input-group">
												<span class="input-group-btn">
													<button class="btn btn-default btn-icon legitRipple"
                                                            type="button"><i class="icon-user"></i></button>
												</span>
                                            <select name="search" class="select">
                                                <option disabled selected>Filtar por:</option>
                                                <option value="created"{{ request('search')=='created'?' selected':'' }}>Novo</option>
                                                <option value="updated"{{ request('search')=='updated'?' selected':'' }}>Atualização</option>
                                                <option value="deleted"{{ request('search')=='deleted'?' selected':'' }}>Remoção</option>
                                            </select>
                                            <span class="input-group-btn">
													<button class="btn btn-default legitRipple"
                                                            type="submit">Pesquisar</button>
												</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-framed table-bordered table-striped text-size-base"
                           data-form="deleteForm">
                        <thead>
                        <tr>
                            <th width="70">#</th>
                            <th width="120">Evento/Ação</th>
                            <th>Usuário</th>
                            <th width="130">Tabela</th>
                            <th width="80">IP</th>
                            <th width="180" onclick="return window.open('{{ route('admin.auditor',array_merge(request()->all(), ['orderBy' => 'created_at'])) }}','_self')">Data</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($auditors as $auditor)
                            <tr>
                                <td>{{ $auditor->id }}</td>
                                <td>{{ $auditor->event }}</td>
                                <td>{{ $auditor->name }}</td>
                                <td>{{ array_last_value($auditor->item,"\\") }}</td>
                                <td>{{ $auditor->ip }}</td>
                                <td>{{ $auditor->created_at->format('d/m/Y - H:i') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pull-right">{{ $auditors->appends(request()->all())->links() }}</div>
                </div>
            </div>
        </div>
    </div>

@stop