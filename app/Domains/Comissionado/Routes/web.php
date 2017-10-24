<?php

$this->group(['prefix' => 'dashboard'],function (){
    $this->group(['prefix' => 'comissionado'], function (){
        $this->get('/','CargoComissionadoController@index')->middleware('permission:ver-cargos-comissionados')->name('admin.comissionados');
        $this->get('/create','CargoComissionadoController@create')->middleware('permission:criar-cargos-comissionados')->name('admin.comissionados.create');
        $this->post('/','CargoComissionadoController@store')->middleware('permission:criar-cargos-comissionados')->name('admin.comissionados.store');
        $this->get('/{id}/show','CargoComissionadoController@show')->middleware('permission:ver-cargos-comissionados')->name('admin.comissionados.show');
        $this->get('/{id}','CargoComissionadoController@edit')->middleware('permission:atualizar-cargos-comissionados')->name('admin.comissionados.edit');
        $this->patch('/{id}','CargoComissionadoController@update')->middleware('permission:atualizar-cargos-comissionados')->name('admin.comissionados.update');
        $this->delete('/{id}','CargoComissionadoController@destroy')->middleware('permission:remover-cargos-comissionados')->name('admin.comissionados.destroy');
    });
    $this->group(['prefix' => 'instrucao'], function (){
        $this->get('/','GrauInstrucaoController@index')->middleware('permission:ver-grau-instrucao')->name('admin.instrucao');
        $this->get('/create','GrauInstrucaoController@create')->middleware('permission:criar-grau-instrucao')->name('admin.instrucao.create');
        $this->post('/','GrauInstrucaoController@store')->middleware('permission:criar-grau-instrucao')->name('admin.instrucao.store');
        $this->get('/{id}/show','GrauInstrucaoController@show')->middleware('permission:ver-grau-instrucao')->name('admin.instrucao.show');
        $this->get('/{id}','GrauInstrucaoController@edit')->middleware('permission:atualizar-grau-instrucao')->name('admin.instrucao.edit');
        $this->patch('/{id}','GrauInstrucaoController@update')->middleware('permission:atualizar-grau-instrucao')->name('admin.instrucao.update');
        $this->delete('/{id}','GrauInstrucaoController@destroy')->middleware('permission:remover-grau-instrucao')->name('admin.instrucao.destroy');
    });
    $this->group(['prefix' => 'nomenclatura'], function (){
        $this->get('/','NomenclaturaCargoController@index')->middleware('permission:ver-nomenclatura')->name('admin.nomenclatura');
        $this->get('/create','NomenclaturaCargoController@create')->middleware('permission:criar-nomenclatura')->name('admin.nomenclatura.create');
        $this->post('/','NomenclaturaCargoController@store')->middleware('permission:criar-nomenclatura')->name('admin.nomenclatura.store');
        $this->get('/{id}/show','NomenclaturaCargoController@show')->middleware('permission:ver-nomenclatura')->name('admin.nomenclatura.show');
        $this->get('/{id}','NomenclaturaCargoController@edit')->middleware('permission:atualizar-nomenclatura')->name('admin.nomenclatura.edit');
        $this->patch('/{id}','NomenclaturaCargoController@update')->middleware('permission:atualizar-nomenclatura')->name('admin.nomenclatura.update');
        $this->delete('/{id}','NomenclaturaCargoController@destroy')->middleware('permission:remover-nomenclatura')->name('admin.nomenclatura.destroy');
    });

    $this->group(['prefix' => 'regime'], function (){
        $this->get('/','RegimeTrabController@index')->middleware('permission:ver-regime-trabalho')->name('admin.regime');
        $this->get('/create','RegimeTrabController@create')->middleware('permission:criar-regime-trabalho')->name('admin.regime.create');
        $this->post('/','RegimeTrabController@store')->middleware('permission:criar-regime-trabalho')->name('admin.regime.store');
        $this->get('/{id}/show','RegimeTrabController@show')->middleware('permission:ver-regime-trabalho')->name('admin.regime.show');
        $this->get('/{id}','RegimeTrabController@edit')->middleware('permission:atualizar-regime-trabalho')->name('admin.regime.edit');
        $this->patch('/{id}','RegimeTrabController@update')->middleware('permission:atualizar-regime-trabalho')->name('admin.regime.update');
        $this->delete('/{id}','RegimeTrabController@destroy')->middleware('permission:remover-regime-trabalho')->name('admin.regime.destroy');
    });

    $this->group(['prefix' => 'secretarias'], function (){
        $this->get('/','SecretariasController@index')->middleware('permission:ver-secretarias')->name('admin.secretarias');
        $this->get('/create','SecretariasController@create')->middleware('permission:criar-secretarias')->name('admin.secretarias.create');
        $this->post('/','SecretariasController@store')->middleware('permission:criar-secretarias')->name('admin.secretarias.store');
        $this->get('/{id}/show','SecretariasController@show')->middleware('permission:ver-secretarias')->name('admin.secretarias.show');
        $this->get('/{id}','SecretariasController@edit')->middleware('permission:atualizar-secretarias')->name('admin.secretarias.edit');
        $this->patch('/{id}','SecretariasController@update')->middleware('permission:atualizar-secretarias')->name('admin.secretarias.update');
        $this->delete('/{id}','SecretariasController@destroy')->middleware('permission:remover-secretarias')->name('admin.secretarias.destroy');
    });

    $this->group(['prefix' => 'cargos'], function (){
        $this->get('/','TipoCargoController@index')->middleware('permission:ver-tipo-cargos')->name('admin.cargos');
        $this->get('/create','TipoCargoController@create')->middleware('permission:criar-tipo-cargos')->name('admin.cargos.create');
        $this->post('/','TipoCargoController@store')->middleware('permission:criar-tipo-cargos')->name('admin.cargos.store');
        $this->get('/{id}/show','TipoCargoController@show')->middleware('permission:ver-tipo-cargos')->name('admin.cargos.show');
        $this->get('/{id}','TipoCargoController@edit')->middleware('permission:atualizar-tipo-cargos')->name('admin.cargos.edit');
        $this->patch('/{id}','TipoCargoController@update')->middleware('permission:atualizar-tipo-cargos')->name('admin.cargos.update');
        $this->delete('/{id}','TipoCargoController@destroy')->middleware('permission:remover-tipo-cargos')->name('admin.cargos.destroy');
    });

    $this->group(['prefix' => 'linhas'], function (){
        $this->get('/','LinhaOnibusController@index')->middleware('permission:ver-linha-onibus')->name('admin.linhas');
        $this->get('/create','LinhaOnibusController@create')->middleware('permission:criar-linha-onibus')->name('admin.linhas.create');
        $this->post('/','LinhaOnibusController@store')->middleware('permission:criar-linha-onibus')->name('admin.linhas.store');
        $this->get('/{id}','LinhaOnibusController@edit')->middleware('permission:atualizar-linha-onibus')->name('admin.linhas.edit');
        $this->patch('/{id}','LinhaOnibusController@update')->middleware('permission:atualizar-linha-onibus')->name('admin.linhas.update');
        $this->delete('/{id}','LinhaOnibusController@destroy')->middleware('permission:remover-linha-onibus')->name('admin.linhas.destroy');
    });

    $this->group(['prefix' => 'servidores'], function (){
        $this->get('/','ServidorController@index')->middleware('permission:ver-servidores')->name('admin.servidores');
        $this->get('/data','ServidorController@data');
        $this->get('/create','ServidorController@create')->middleware('permission:criar-servidores')->name('admin.servidores.create');
        $this->post('/','ServidorController@store')->middleware('permission:criar-servidores')->name('admin.servidores.store');
        $this->get('/{id}/show','ServidorController@show')->name('admin.servidores.show');
        $this->get('/{id}','ServidorController@edit')->middleware('permission:atualizar-servidores')->name('admin.servidores.edit');
        $this->patch('/{id}','ServidorController@update')->middleware('permission:atualizar-servidores')->name('admin.servidores.update');
        $this->delete('/{id}','ServidorController@destroy')->middleware('permission:atualizar-servidores')->name('admin.servidores.destroy');
    });

    $this->group(['prefix' => 'validacao'], function (){
        $this->get('/','ValidacaoController@index')->middleware('permission:ver-validacao')->name('admin.validacao');
        $this->get('/data','ValidacaoController@data');
        $this->get('/{id}','ValidacaoController@getServidor')->middleware('permission:criar-validacao')->name('admin.validacao.find');
        $this->patch('/{id}/valida','ValidacaoController@postValidacao')->middleware('permission:atualizar-validacao')->name('admin.validacao.update');
        $this->get('/{id}/revalidar','ValidacaoController@getRevalidar')->name('admin.validacao.revalidar');
        $this->get('/nomear','ValidacaoController@getValidador')->name('admin.validacao.nomear');
    });
});