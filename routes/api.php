<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('clientes', 'ClienteController@getClientes');
Route::get('cliente/{id}', 'ClienteController@getCliente');
Route::post('cliente', 'ClienteController@createCliente');
Route::put('cliente/{id}', 'ClienteController@updateCliente');
Route::delete('cliente/{id}', 'ClienteController@deleteCliente');
