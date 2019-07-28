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

    // user creation start here
    Route::get('/create-role',function(){
        return view('backend.createrole');
    })->name('user.createrole');
    Route::post('/rolesub','backend\UserController@createrole')->name('user.rolesub');
    Route::get('/create-user','backend\UserController@getroles')->name('user.createuser');
    Route::post('/usersub','backend\UserController@createuser')->name('user.usersub');
    Route::get('/edit-user','backend\UserController@editpage')->name('user.editget');
    Route::get('/edit-user/{id}','backend\UserController@editsingle');
    Route::post('/updateuser','backend\UserController@updateuser')->name('user.update');
    Route::post('/updatepass','backend\UserController@updatepass')->name('user.updatepassword');
    Route::get('/delete-user/{id}','backend\UserController@delete')->name('user.deleteuser');

    // notice start here
    Route::get('/create-notice','backend\NoticeController@getnotice')->name('notice.createnotice');
    Route::post('/noticesub','backend\NoticeController@create')->name('notice.noticesub');
    Route::get('/edit-notice','backend\NoticeController@editpage')->name('notice.editnotice');
    Route::get('/edit-notice/{id}','backend\NoticeController@editnotice');
    Route::post('/updatenotice','backend\NoticeController@updatenotice')->name('notice.update');
    Route::get('/delete-notice/{id}','backend\NoticeController@delete')->name('notice.deletenotice');
});

