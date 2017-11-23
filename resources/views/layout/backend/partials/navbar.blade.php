@auth
<!-- Main navbar -->
<div class="navbar navbar-inverse navbar-fixed-top bg-green">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ route('admin.home') }}"><img src="{{ asset('backend/images/logo.png') }}" alt=""></a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs" title="Ocultar Barra"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>

        @auth
        <div class="navbar-right">
            <p class="navbar-text"><span class="label bg-success-400">Online</span></p>

            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-bell2"></i>
                        <span class="visible-xs-inline-block position-right">Notificações</span>
                        <span class="status-mark border-orange-400"></span>
                    </a>

                    <div class="dropdown-menu dropdown-content">
                        <div class="dropdown-content-heading">
                            Notificações do Sistema
                            <ul class="icons-list">
                                <li><a href="#"><i class="icon-menu7"></i></a></li>
                            </ul>
                        </div>

                        <ul class="media-list dropdown-content-body width-350">
                            <li class="media">
                                Sem notificações a serem exibidas
                                <!--
                                <div class="media-left">
                                    <a href="#" class="btn bg-success-400 btn-rounded btn-icon btn-xs"><i class="icon-mention"></i></a>
                                </div>

                                <div class="media-body">
                                    <a href="#">Taylor Swift</a> mentioned you in a post "Angular JS. Tips and tricks"
                                    <div class="media-annotation">4 minutes ago</div>
                                </div>
                                -->
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle legitRipple" data-toggle="dropdown" aria-expanded="true">
                        <span>{{ auth()->user()->name }}</span>
                        <i class="caret"></i>
                        <span class="legitRipple-ripple" style="left: 67.254%; top: 24%; transform: translate3d(-50%, -50%, 0px); width: 212.203%; opacity: 0;"></span></a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                        class="icon-switch2"></i> <span>Sair do sistema</span></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">{{ csrf_field() }}</form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        @endauth
    </div>
</div>
<!-- /main navbar -->
@endauth