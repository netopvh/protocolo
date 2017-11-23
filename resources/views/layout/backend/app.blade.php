<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title',config('app.name'))</title>
    <link rel="icon" href="{{  asset('backend/images/favicon.ico') }}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{  asset('backend/images/favicon.ico') }}" type="image/x-icon"/>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="{{ asset('backend/css/icoomon.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/core.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/colors.min.css') }}" rel="stylesheet" type="text/css">
    @yield('styles')
    <!-- /global stylesheets -->
</head>

<body class="navbar-top">

@include('layout.backend.partials.navbar')

<!-- Page container -->
<div class="page-container" style="">

    <!-- Page content -->
    <div class="page-content">

    @include('layout.backend.partials.sidebar')

    <!-- Main content -->
        <div class="content-wrapper">

        @auth
        <!-- Page header -->
            <div class="page-header page-header-default">

                @yield('page-header')

                @yield('breadcrumb')
            </div>
            <!-- /page header -->
        @endauth


        <!-- Content area -->
            <div class="content">

            @yield('content')

            <!-- Footer -->
                <div class="footer text-grey-600 text-bold">
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
@include('sweet::alert')
<!-- /theme JS files -->
</body>
</html>
