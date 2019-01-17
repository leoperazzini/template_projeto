<?php

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
Route::get('/entrega/listar/', 'EntregaController@listar');

Route::get('/', 'EntregaController@listar');

Route::get('/entrega/cadastrar', 'EntregaController@cadastrar');

Route::post('/entrega/cadastrar', 'EntregaController@cadastrar');

Route::get('/entrega/editar/id/{editar}', 'EntregaController@editar');

Route::patch('/entrega/editar/id/{editar}', 'EntregaController@editar');

Route::get('/entrega/deletar/id/{roterizacao}', 'EntregaController@deletar');

Route::get('/rota/roterizacao/id/{roterizacao}', 'RotaController@roterizacao');
  