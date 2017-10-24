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


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">

                <!-- Advanced login -->
                <form class="form-horizontal form-validate-jquery" method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="panel panel-body login-form">
                        <div class="text-center">
                            <div class="icon-object border-success text-success"><i class="icon-pencil4"></i></div>
                            <h5 class="content-group">Alteração de senha
                                <small class="display-block">Preencha todos os campos</small>
                            </h5>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input id="email" type="email" name="email" value="{{ $email or old('email') }}"
                                   class="form-control" placeholder="Seu email" required autofocus>
                            <div class="form-control-feedback">
                                <i class="icon-mention text-muted"></i>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input id="password" type="password" class="form-control" name="password" required placeholder="Senha">
                            <div class="form-control-feedback">
                                <i class="icon-user-lock text-muted"></i>
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirmar senha">
                            <div class="form-control-feedback">
                                <i class="icon-user-lock text-muted"></i>
                            </div>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block text-danger">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <button type="submit" class="btn bg-pink-400 btn-block btn-lg">Atualizar Senha <i
                                    class="icon-circle-right2 position-right"></i></button>
                    </div>
                </form>
                <!-- /advanced login -->


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
