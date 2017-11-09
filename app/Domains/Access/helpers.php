<?php

if(! function_exists('in_admin_group')){
    function in_admin_group(){
        return in_array(auth()->user()->roles->first()->id,[config('protocolo.role_admin')]);
    }
}

if (! function_exists('user_dpt')){
    function user_dpt($id){
        return \App\Domains\Access\Models\User::find($id)->id_departamento;
    }
}