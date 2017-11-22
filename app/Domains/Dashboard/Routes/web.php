<?php

$this->get('/documentos','HomeController@data');
$this->get('/dashboard', 'HomeController@index')->name('admin.home');