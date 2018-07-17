<?php

use Illuminate\Http\Request;

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


Route::get('/pedidos/{conductor_id}', 'PedidoController@listado')->where('conductor_id', '[0-9]+');

Route::post('/pedido', 'PedidoController@nuevo');