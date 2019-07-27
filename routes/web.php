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

Route::prefix('admin')->group(function () {
    Route::get('/create-role',function(){
        return view('backend.createrole');
    })->name('user.createrole');
    Route::post('/rolesub','backend\UserController@createrole')->name('user.rolesub');
    Route::get('/create-user','backend\UserController@getroles')->name('user.createuser');
    Route::post('/usersub','backend\UserController@createuser')->name('user.usersub');
});

