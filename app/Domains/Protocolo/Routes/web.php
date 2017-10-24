<?php

$this->group(['prefix' => 'dashboard'],function (){
    $this->group(['prefix' => 'departamento'], function (){
        $this->get('/','DepartamentoController@index')->name('admin.departamento');
        $this->get('/data','DepartamentoController@data');
        $this->get('/create','DepartamentoController@create')->name('admin.departamento.create');
        $this->post('/create','DepartamentoController@store')->name('admin.departamento.store');
        $this->get('/{id}/edit','DepartamentoController@edit')->name('admin.departamento.edit');
        $this->patch('/{id}/edit','DepartamentoController@update')->name('admin.departamento.update');
        $this->delete('/{id}/destroy','DepartamentoController@destroy')->name('admin.departamento.destroy');
    });
    $this->group(['prefix' => 'tipodoc'], function (){
        $this->get('/','TipoDocumentoController@index')->name('admin.tipo_documento');
        $this->get('/data','TipoDocumentoController@data');
        $this->get('/create','TipoDocumentoController@create')->name('admin.tipo_documento.create');
        $this->post('/create','TipoDocumentoController@store')->name('admin.tipo_documento.store');
        $this->get('/{id}/edit','TipoDocumentoController@edit')->name('admin.tipo_documento.edit');
        $this->patch('/{id}/edit','TipoDocumentoController@update')->name('admin.tipo_documento.update');
        $this->delete('/{id}/destroy','TipoDocumentoController@destroy')->name('admin.tipo_documento.destroy');
    });
    $this->group(['prefix' => 'documento'], function (){
        $this->get('/','DocumentoController@index')->name('admin.documento');
        $this->get('/data','DocumentoController@data');
        $this->get('/create','DocumentoController@create')->name('admin.documento.create');
        $this->post('/create','DocumentoController@store')->name('admin.documento.store');
        $this->get('/{id}/show','DocumentoController@show')->name('admin.documento.show');
        $this->get('/{id}/edit','DocumentoController@edit')->name('admin.documento.edit');
        $this->patch('/{id}/edit','DocumentoController@update')->name('admin.documento.update');
        $this->delete('/{id}/destroy','DocumentoController@destroy')->name('admin.documento.destroy');
    });

    $this->group(['prefix' => 'secretarias'], function (){
        $this->get('/','SecretariasController@index')->name('admin.secretarias');
        $this->get('/create','SecretariasController@create')->name('admin.secretarias.create');
        $this->post('/','SecretariasController@store')->name('admin.secretarias.store');
        $this->get('/{id}/show','SecretariasController@show')->name('admin.secretarias.show');
        $this->get('/{id}','SecretariasController@edit')->name('admin.secretarias.edit');
        $this->patch('/{id}','SecretariasController@update')->name('admin.secretarias.update');
        $this->delete('/{id}','SecretariasController@destroy')->name('admin.secretarias.destroy');
    });
});