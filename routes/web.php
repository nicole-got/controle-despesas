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
Route::get('/', ['as'=>'viewlogin','uses' => 'App\Http\Controllers\Controller@viewlogin']);
Route::get('/error', ['as'=>'error','uses' => 'App\Http\Controllers\Controller@error']);
Route::get('/cadastro', 'App\Http\Controllers\Controller@cadastrar');

Route::post('/auth', ['as'=> 'user.login', 'uses' => 'App\Http\Controllers\DashboardController@auth']);
Route::get('/dashboard', ['as'=> 'user.dashboard', 'uses' => 'App\Http\Controllers\DashboardController@index']);
Route::get('/cadastrar', ['as'=> 'user.cadastrar', 'uses' => 'App\Http\Controllers\UsersController@cadastrar']);
Route::any('expenses/search', ['as'=>'expense.search', 'uses' => 'App\Http\Controllers\ExpensesController@search']);
Route::resource('user', 'App\Http\Controllers\UsersController');
Route::resource('expense', 'App\Http\Controllers\ExpensesController');

