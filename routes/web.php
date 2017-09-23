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
    return view('home', [
        'pagename' => 'home'
    ]);
});
Route::get('music', function () {
    return view('music', [
        'pagename' => 'music'
    ]);
});

Route::get('code', function () {
    return view('code', [
        'pagename' => 'code'
    ]);
});

Route::get('important', function () {
    return view('important', [
        'pagename' => 'important'
    ]);
});


Route::get('blog', 'BlogController@index');

Route::get('blog/{id}', 'BlogController@show');

Route::get('contact', function () {
    return view('contact', [
        'pagename' => 'contact'
    ]);
});
