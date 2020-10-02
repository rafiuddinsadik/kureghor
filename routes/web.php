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

use App\User;

Route::post('registeruser', function (\Illuminate\Http\Request $request){
    \Illuminate\Support\Facades\DB::table('users')->insert([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
    ]);
    return redirect()->route('/');
});

Route::get('json-parse', function (\Illuminate\Http\Request $request){
    return response()->json(['name' => 'Rafi Uddin', 'email'=>'rafiuddinsadik@gmail.com'], 200);
});

Route::get('session-test', function (\Illuminate\Http\Request $request){
    $foo = $request->foo;
    return view('welcome')->with([$foo]);
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Admin routes. Just add the admin middleware to your route groups, bang! They are secured!
Route::group([
    'middleware' => 'guest',
    'prefix' => 'admin',
    'namespace' => 'Admin'
], function () {
    Route::get('dashboard', 'DashboardController@index')->name('admin.index');


    //Books
    Route::get('books/list', 'BookController@index')->name('admin.book.list');
    Route::get('books/create', 'BookController@create')->name('admin.book.create');
    Route::post('books/add', 'BookController@add')->name('admin.book.add');
    Route::get('books/modify/{slug}', 'BookController@modify')->name('admin.book.modify');
    Route::post('books/update/{slug}', 'BookController@update')->name('admin.book.update');

    //categories
    Route::get('categories', 'CategoryController@index')->name('admin.categories');
    Route::post('cateogories/add', 'CategoryController@add')->name('admin.categories.add');
    Route::get('cateogories/modify/{slug}', 'CategoryController@modify')->name('admin.categories.modify');
    Route::post('cateogories/update/{slug}', 'CategoryController@update')->name('admin.categories.update');
    Route::get('cateogories/delete/{slug}', 'CategoryController@delete')->name('admin.categories.delete');

    //authors
    Route::get('authors','AuthorController@index')->name('admin.authors');
    Route::post('authors/add','AuthorController@add')->name('admin.authors.add');
    Route::get('authors/modify/{slug}', 'AuthorController@modify')->name('admin.authors.modify');
    Route::post('authors/update/{slug}', 'AuthorController@update')->name('admin.authors.update');
    Route::get('authors/delete/{slug}', 'AuthorController@delete')->name('admin.authors.delete');

    //translators
    Route::get('translators','TranslatorController@index')->name('admin.translators');
    Route::post('translators/add','TranslatorController@add')->name('admin.translators.add');
    Route::get('translators/modify/{slug}', 'TranslatorController@modify')->name('admin.translators.modify');
    Route::post('translators/update/{slug}', 'TranslatorController@update')->name('admin.translators.update');
    Route::get('translators/delete/{slug}', 'TranslatorController@delete')->name('admin.translators.delete');

    //publishers
    Route::get('publishers','PublisherController@index')->name('admin.publishers');
    Route::post('publishers/add','PublisherController@add')->name('admin.publishers.add');


    //payment method
    Route::get('payment/methods', 'SettingsController@paymentMethodIndex')->name('admin.payment.method');
    Route::post('payment/methods/bkashupdate', 'SettingsController@bkashNumUpdate')->name('admin.payment.bkash.update.num');
    Route::post('payment/methods/dchargeupdate', 'SettingsController@deliveryChargeUpdate')->name('admin.payment.dcharge.update');
    Route::get('payment/methods/status/switch/{var}', 'SettingsController@methodStatusSwitch')->name('admin.payment.method.switch');
});

Route::group([
    'middleware' => 'publisher',
    'prefix' => 'publisher',
    'namespace' => 'Publisher'
], function () {
    Route::get('dashboard', function (){
       return "Publisher Dashboard";
    });
});

