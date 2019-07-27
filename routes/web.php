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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/group', 'FilesController@index');
Route::get('/group/add', 'FilesController@add_group');
Route::get('/group/show', 'FilesController@show');

Route::get('/files', 'FilesController@index');
Route::get('/files/add/{group_id}', 'FilesController@add');
Route::get('/files/update/{group_id}', 'FilesController@add');
Route::post('/files/add/{group_id}', 'FilesController@store');
Route::get('/group/remove/{id}', 'FilesController@remove');

Route::get('/analize/popular', 'MessagesController@popular');

//Route::post('files', 'FilesController@store');
Route::post('group', 'FilesController@store_group');