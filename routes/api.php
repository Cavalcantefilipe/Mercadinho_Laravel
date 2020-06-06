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

Route::get('produtos', 'ProdutoController@getProdutos');
Route::get('produto/{id}', 'ProdutoController@getProduto');
Route::post('produto', 'ProdutoController@createProduto');
Route::put('produto/{id}', 'ProdutoController@updateProduto');
Route::delete('produto/{id}', 'ProdutoController@deleteProduto');

Route::get('vendas/{id?}', 'VendaController@getVendas');
Route::get('venda/{id}', 'VendaController@getVenda');
Route::post('venda', 'VendaController@createVenda');
Route::put('venda/{id}', 'VendaController@updateVenda');
Route::delete('venda/{id}', 'VendaController@deleteVenda');

Route::post('add/itemVenda/{id}', 'VendaController@addItemVenda');
Route::delete('remove/itemVenda/{id}', 'VendaController@removeItemVenda');
Route::put('finalizaVenda/{id}', 'VendaController@finalizarVenda');
Route::get('itensVenda/{id?}', 'VendaController@getitensVenda');
