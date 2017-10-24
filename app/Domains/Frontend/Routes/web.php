<?php

Route::get('/','HomeController@index')->name('home');

// Registration Routes...
Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'RegisterController@register');
