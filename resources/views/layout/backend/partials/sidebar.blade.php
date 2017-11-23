@auth
<!-- Main sidebar -->
<div class="sidebar sidebar-main sidebar-default sidebar-fixed">
    <div class="sidebar-content">
        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Gerenciamento -->
                    <li class="{{ active('dashboard') }}">
                        <a href="{{ route('admin.home') }}">
                            <i class="icon-home4"></i>
                            <span>Início</span>
                        </a>
                    </li>
                    <li class="navigation-header">
                        <span>Módulo Protocolo</span>
                        <i class="icon-menu" title="Gerenciamento"></i>
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-stack"></i>
                            <span class="text-bold">Cadastros</span>
                        </a>
                        <ul>
                            <li class="{{ active(['admin.departamento','admin.departamento.*']) }}">
                                <a href="{{ route('admin.departamento') }}">
                                    <i class="icon-portfolio"></i>
                                    <span class="text-bold">Departamentos</span>
                                </a>
                            </li>
                            <li class="{{ active(['admin.secretarias','admin.secretarias.*']) }}">
                                <a href="{{ route('admin.secretarias') }}">
                                    <i class="icon-office"></i>
                                    <span class="text-bold">Órgãos/Secretarias</span>
                                </a>
                            </li>
                            <li class="{{ active(['admin.tipo_documento','admin.tipo_documento.*']) }}">
                                <a href="{{ route('admin.tipo_documento') }}">
                                    <i class="icon-stack"></i>
                                    <span class="text-bold">Tipos de Documentos</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ active(['admin.documento','admin.documento.*']) }}">
                        <a href="{{ route('admin.tramitacao') }}">
                            <i class="icon-magazine"></i>
                            <span class="text-bold">Tramitação de Documentos</span>
                        </a>
                    </li>
                    <!-- /gerenciamento -->

                @permission('ver-administracao')
                <!-- Administração -->
                    <li class="navigation-header">
                        <span>Módulo Administrativo</span>
                        <i class="icon-menu" title="Administração"></i>
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-stack"></i>
                            <span>Gerenciamento de Acesso</span>
                        </a>
                        <ul>
                            @permission('ver-usuario')
                            <li class="{{ active(['admin.users','admin.users.*']) }}">
                                <a href="{{ route('admin.users') }}">
                                    <i class="icon-user"></i>
                                    <span class="text-bold">Usuários</span>
                                </a>
                            </li>
                            @endpermission
                            @permission('ver-perfil')
                            <li class="{{ active(['admin.roles','admin.roles.*']) }}">
                                <a href="{{ route('admin.roles') }}">
                                    <i class="icon-users4"></i>
                                    <span class="text-bold">Perfil de Acesso</span>
                                </a>
                            </li>
                            @endpermission
                        </ul>
                    </li>
                    @permission('ver-parametros')
                    <li><a href=""><i class="icon-cog"></i> Parâmetros do Sistema</a></li>
                    @endpermission
                    @permission('ver-auditoria')
                    <li class="{{ active(['admin.auditor']) }}"><a href="{{ route('admin.auditor') }}"><i class="icon-stack-star"></i> Auditoria e Logs</a></li>
                    @endpermission
                <!-- /administracao -->
                    @endpermission
                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
<!-- /main sidebar -->
@endauth