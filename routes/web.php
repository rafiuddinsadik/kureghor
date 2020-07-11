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


//Admin routes. Just add the admin middleware to your route groups, bang! They are secured!
Route::group([
    'middleware' => 'admin',
    'prefix' => 'admin',
    'namespace' => 'Admin'
], function () {
    Route::get('dashboard', 'DashboardController@index')->name('admin.index');

    //categories
    Route::get('categories', 'CategoryController@index')->name('admin.categories');
    Route::post('cateogories/add', 'CategoryController@add')->name('admin.categories.add');
    Route::get('cateogories/modify/{slug}', 'CategoryController@modify')->name('admin.categories.modify');
    Route::post('cateogories/update/{slug}', 'CategoryController@update')->name('admin.categories.update');
    Route::get('cateogories/delete/{slug}', 'CategoryController@delete')->name('admin.categories.delete');
});
