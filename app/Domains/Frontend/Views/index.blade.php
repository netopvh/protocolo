<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Acesso ao Sistema')</title>

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

<body>


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">


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
<script type="text/javascript" src="{{ mix('backend/js/plugins/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ mix('backend/js/plugins/select2.pt-BR.js') }}"></script>
<script type="text/javascript" src="{{ mix('backend/js/plugins/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ mix('backend/js/plugins/additional-methods.min.js') }}"></script>
<script type="text/javascript" src="{{ mix('backend/js/plugins/messages_pt_BR.min.js') }}"></script>
<script type="text/javascript" src="{{ mix('backend/js/plugins/nicescroll.min.js') }}"></script>
@stack('scripts-before')

<script type="text/javascript" src="{{ mix('backend/js/bundle.js') }}"></script>
@stack('scripts-after')
<!-- /theme JS files -->
</body>
</html>
