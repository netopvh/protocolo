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

$this->group(['prefix' => 'dashboard','middleware' => ['permission:ver-administracao']],function (){
    $this->group(['prefix' => 'users'], function (){
        $this->get('/','UserController@index')->middleware('permission:ver-administracao')->name('admin.users');
        $this->get('/create','UserController@create')->middleware('permission:criar-usuario')->name('admin.users.create');
        $this->post('/','UserController@store')->middleware('permission:criar-usuario')->name('admin.users.store');
        $this->get('/{id}','UserController@edit')->middleware('permission:atualizar-usuario')->name('admin.users.edit');
        $this->patch('/{id}','UserController@update')->middleware('permission:atualizar-usuario')->name('admin.users.update');
        $this->delete('/{id}','UserController@destroy')->middleware('permission:remover-usuario')->name('admin.users.destroy');
    });

    $this->group(['prefix' => 'roles'], function (){
        $this->get('/','RoleController@index')->middleware('permission:ver-administracao')->name('admin.roles');
        $this->get('/create','RoleController@create')->middleware('permission:criar-perfil')->name('admin.roles.create');
        $this->post('/','RoleController@store')->middleware('permission:criar-perfil')->name('admin.roles.store');
        $this->get('/{id}','RoleController@edit')->middleware('permission:atualizar-perfil')->name('admin.roles.edit');
        $this->patch('/{id}','RoleController@update')->middleware('permission:atualizar-perfil')->name('admin.roles.update');
        $this->delete('/{id}','RoleController@destroy')->middleware('permission:remover-peril')->name('admin.roles.destroy');
    });

    $this->group(['prefix' => 'audit'], function (){
        $this->get('/','AuditController@index')->middleware('permission:ver-administracao')->name('admin.auditor');
    });

    $this->group(['prefix' => 'account'], function (){
        $this->get('/','ContaController@index')->name('admin.account');
    });
});