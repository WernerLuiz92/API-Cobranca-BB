<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('token', 'App\Http\Controllers\APIController@token')
->name('token');

Route::get('register', 'App\Http\Controllers\APIController@register')
->name('registrar');

Route::get('listAll', 'App\Http\Controllers\APIController@listAll')
->name('listarTodas');

Route::get('findOne', 'App\Http\Controllers\APIController@findOne')
->name('consultar');

Route::get('terminate', 'App\Http\Controllers\APIController@terminate')
->name('darBaixa');

Route::get('update', 'App\Http\Controllers\APIController@update')
->name('atualizar');
