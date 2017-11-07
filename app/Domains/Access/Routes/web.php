<?php

// Authentication Routes...
$this->get('login', 'LoginController@showLoginForm')->name('login');
$this->post('login', 'LoginController@login');
$this->post('logout', 'LoginController@logout')->name('logout');

// Password Reset Routes...
//$this->get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
//$this->post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//$this->get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
//$this->post('password/reset', 'ResetPasswordController@reset');

$this->group(['prefix' => 'dashboard'],function (){
    $this->group(['prefix' => 'users'], function (){
        $this->get('/departamento','UserController@getDepartamento')->name('admin.users.departamento');
        $this->patch('/secretaria/{id}','UserController@postDepartamento')->name('admin.users.departamento.update');
        $this->get('/',['middleware' => ['permission:ver-administracao|ver-usuario,require_all'], 'uses' => 'UserController@index'])->name('admin.users');
        $this->get('/create',['middleware' => ['permission:ver-administracao|criar-usuario,require_all'], 'uses' => 'UserController@create'])->name('admin.users.create');
        $this->post('/',['middleware' => ['permission:ver-administracao|criar-usuario,require_all'], 'uses' => 'UserController@store'])->name('admin.users.store');
        $this->get('/{id}',['middleware' => ['permission:ver-administracao|atualizar-usuario,require_all'], 'uses' => 'UserController@edit'])->name('admin.users.edit');
        $this->patch('/{id}',['middleware' => ['permission:ver-administracao|atualizar-usuario,require_all'], 'uses' => 'UserController@update'])->name('admin.users.update');
        $this->delete('/{id}',['middleware' => ['permission:ver-administracao|remover-usuario,require_all'], 'uses' => 'UserController@destroy'])->name('admin.users.destroy');
    });

    $this->group(['prefix' => 'roles'], function (){
        $this->get('/',['middleware' => ['permission:ver-administracao|ver-perfil,require_all'], 'uses' => 'RoleController@index'])->name('admin.roles');
        $this->get('/create',['middleware' => ['permission:ver-administracao|criar-perfil,require_all'], 'uses' => 'RoleController@create'])->name('admin.roles.create');
        $this->post('/',['middleware' => ['permission:ver-administracao|criar-perfil,require_all'], 'uses' => 'RoleController@store'])->name('admin.roles.store');
        $this->get('/{id}',['middleware' => ['permission:ver-administracao|atualizar-perfil,require_all'], 'uses' => 'RoleController@edit'])->name('admin.roles.edit');
        $this->patch('/{id}',['middleware' => ['permission:ver-administracao|atualizar-perfil,require_all'], 'uses' => 'RoleController@update'])->name('admin.roles.update');
        $this->delete('/{id}',['middleware' => ['permission:ver-administracao|remover-perfil,require_all'], 'uses' => 'RoleController@destroy'])->name('admin.roles.destroy');
    });

    $this->group(['prefix' => 'audit'], function (){
        $this->get('/',['middleware' => ['permission:ver-administracao|ver-auditoria,require_all'], 'uses' => 'AuditController@index'])->name('admin.auditor');
    });

    $this->group(['prefix' => 'account'], function (){
        $this->get('/','ContaController@index')->name('admin.account');
    });
});