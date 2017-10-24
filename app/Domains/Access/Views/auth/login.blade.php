<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Acesso ao Sistema')</title>
    <link rel="icon" href="{{  asset('backend/images/favicon.ico') }}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{  asset('backend/images/favicon.ico') }}" type="image/x-icon"/>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/icoomon.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/core.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/colors.min.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    <style type="text/css">
        body{
            background: url('backend/images/bg/{{ rand(0,15) }}.jpg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>

</head>

<body class="login-container">


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">

                <!-- Simple login form -->
                <form action="{{ route('login') }}" class="form-validate-jquery" method="POST">
                    {{ csrf_field() }}
                    <div class="panel panel-body login-form">
                        <div class="text-center">
                            <div class="icon-object border-slate-300 text-slate-300"><i class="icon-pen-minus"></i></div>
                            <h5 class="content-group">Sistema de Protocolo
                                <small class="display-block">Entre com sua credenciais</small>
                            </h5>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="text" class="form-control" name="username" placeholder="Usuário"
                                   value="{{ old('username') }}" required autofocus>
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                            @if ($errors->has('username'))
                                <span class="help-block text-danger">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="password" name="password" class="form-control" placeholder="Senha">
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn bg-pink-400 btn-block">Acessar <i
                                        class="icon-circle-right2 position-right"></i></button>
                        </div>
                    </div>
                </form>
                <!-- /simple login form -->


                <!-- Footer -->
                <div class="footer panel text-bold text-center">
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
<script type="text/javascript" src="{{ mix('backend/js/theme.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/select2.pt-BR.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/additional-methods.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/messages_pt_BR.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/nicescroll.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/buttons.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js') }}"></script>
@stack('scripts-before')

<script type="text/javascript" src="{{ mix('backend/js/bundle.js') }}"></script>
@stack('scripts-after')
<!-- /theme JS files -->
</body>
</html>
