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

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if(Auth::check()){
        return view('home');
    }else{
        return view('auth.login');
    }

});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::paginate('users', 'UsersController@index');//这个路由一定要写，不然点击分页的时候会找不到路由

Route::resource('/users','UsersController');

Route::get('/users/{id}/changeStatus/{status}','UsersController@changeStatus');//更改用户状态

Route::resource('notecates','NoteCatesController');

Route::resource('notes','NotesController');

Route::get('/notes/{id}/review/{review}','NotesController@review');//审核笔记

Route::post('upeditor','UploadController@uploadeditor');

