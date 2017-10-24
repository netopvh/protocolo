@extends('layout.backend.app')

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.home') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger alert-styled-left alert-bordered">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                <span class="text-semibold">Ops!</span> Você não tem acesso á esta opçao!, caso deseje acesso á esta área, contacte o administrador do sistema.
            </div>
            <div class="text-center">
                <div class="icon-object border-danger text-danger"><i class="icon-warning2"></i></div>
            </div>
        </div>
    </div>
@stop