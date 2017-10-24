<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Acesso ao Sistema')</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="{{ asset('backend/css/icoomon.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/bundle.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->


</head>

<body class="login-container">

<!-- Main navbar -->
<div class="navbar navbar-inverse bg-indigo">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ route('admin.home') }}"><img src="{{ asset('backend/images/logo.png') }}"
                                                                      alt=""></a>

        <ul class="nav navbar-nav pull-right visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        </ul>
    </div>

</div>
<!-- /main navbar -->


<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">
            <!-- Password recovery -->
                <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                    <div class="panel panel-body login-form">
                        <div class="text-center">
                            <div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
                            <h5 class="content-group">Recuperação de Senha
                                <small class="display-block">As informações serão enviadas para seu email</small>
                            </h5>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="form-group has-feedback">
                            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Seu Email">
                            <div class="form-control-feedback">
                                <i class="icon-mail5 text-muted"></i>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <button type="submit" class="btn bg-pink-400 btn-block">Resetar Senha <i
                                    class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </form>
                <!-- /password recovery -->


                <!-- Footer -->
                <div class="footer text-muted text-center">
                    @include('layout.backend.partials.footer')
                </div>
                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

<!-- Core JS files -->
<script type="text/javascript" src="{{ asset('backend/js/core.js') }}"></script>
<!-- /core JS files -->

<!-- Theme JS files -->
<script type="text/javascript" src="{{ asset('backend/js/theme.js') }}"></script>
@stack('scripts-before')

<script type="text/javascript" src="{{ asset('backend/js/bundle-72aef62a47.js') }}"></script>
@stack('scripts-after')
<!-- /theme JS files -->
</body>
</html>

