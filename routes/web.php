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

Route::post('/file/upload','FileController@upload')->name('file.upload');
Route::post('/file/rename','FileController@rename')->name('file.rename');
Route::get('/file/delete/{id}','FileController@delete')->name('file.delete');
Route::post('/directory/create','DirectoryController@createDirectory')->name('directory.create');
Route::post('/directory/rename','DirectoryController@rename')->name('directory.rename');
Route::get('/directory/delete/{id}','DirectoryController@delete')->name('directory.delete');
Route::get('/directory/{id}', 'DirectoryController@show')->name('directory.show');


Route::get('/verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');

Route::get('/home', 'HomeController@index')->name('home');
