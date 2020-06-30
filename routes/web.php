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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'HomeController@index')->name('home');

Route::post('/home/search', [
    'uses' => 'HomeController@search'
]);
Route::post('/home/create', [
    'uses' => 'HomeController@create'
]);
//Route::post('Home/cities','HomeController@cities')->name('Home.city');


Route::get("home/cities/{id}", "HomeController@cities");
Auth::routes();
Route::get('pagination',array('as'=>'ajax.pagination','uses'=>'HomeController@index'));


