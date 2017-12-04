<?php

$this->get('/', function (){
    return redirect()->route('admin.home');
});
$this->get('/documentos','HomeController@data');
$this->get('/dashboard', 'HomeController@index')->name('admin.home');