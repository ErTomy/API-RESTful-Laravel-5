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


Route::get('/pedidos/{token}', 'PedidoController@listado');
Route::get('/pedidos/{token}/{dia}-{mes}-{anno}', 'PedidoController@listado')->where('dia', '[0-9]+')
                                                                             ->where('mes', '[0-9]+')
                                                                             ->where('anno', '[0-9]+');

Route::post('/pedido', 'PedidoController@nuevo');