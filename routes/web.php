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

Route::get('CriarCliente', function () {
    return view('AddCliente');
});

Route::get('Cliente', function () {
    return view('cliente');
});

Route::get('CriarProduto', function () {
    return view('addProduto');
});

Route::get('Produto', function () {
    return view('produto');
});

Route::get('Venda', function () {
    return view('cart');
});

Route::get('Bonus', function () {
    return view('bonus');
});


