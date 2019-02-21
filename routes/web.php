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
// Route::get('/entrega/listar/', 'EntregaController@listar');

// Route::get('/', 'EntregaController@listar');

// Route::get('/entrega/cadastrar', 'EntregaController@cadastrar');

// Route::post('/entrega/cadastrar', 'EntregaController@cadastrar');

// Route::get('/entrega/editar/id/{editar}', 'EntregaController@editar');

// Route::patch('/entrega/editar/id/{editar}', 'EntregaController@editar');

// Route::get('/entrega/deletar/id/{roterizacao}', 'EntregaController@deletar');

// Route::get('/rota/roterizacao/id/{roterizacao}', 'RotaController@roterizacao');

Auth::routes();
   
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index');
    Route::get('/', 'HomeController@index');
    Route::get('/logout', 'AuthController@logout'); 
    
    Route::get('/users/getall', 'UsersController@getall');
    Route::get('/users/profile', 'UsersController@profile');
    Route::get('/users/store', 'UsersController@store'); 
    Route::post('/users/store', 'UsersController@store'); 
}); 
  
Route::get('/login', 'AuthController@login')->name('login');; 
  
Route::post('/login', 'AuthController@login');
