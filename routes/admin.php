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
define('PAGINATION_COUNT',10);
//**************************************Login***************************************
Route::group(['namespace'=>'Admin' ,'middleware'=>'guest:admin'],function (){

    Route::get('login','LoginController@getLogin')->name('admin');
    Route::post('login','LoginController@login')->name('admin.login');


});
//*************************************Admin**************************************************
Route::group(['namespace'=>'Admin' ,'middleware'=>'auth:admin'],function (){

    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
    //*******************************************Language Routes*******************************
    Route::group(['prefix'=>'languages'],function (){

        Route::get('/', 'LanguageController@index')->name('admin.languages');
        //Create Routes
        Route::get('create','LanguageController@create')->name('admin.languages.create');
        Route::post('save','LanguageController@save')->name('admin.languages.save');
        //Update Routes
        Route::get('edit/{id}','LanguageController@edit')->name('admin.languages.edit');
        Route::post('update/{id}','LanguageController@update')->name('admin.languages.update');
        //Delete
        Route::get('delete/{id}','LanguageController@delete')->name('admin.languages.delete');


    });

    //*******************************************End Language Routes*******************************


 //*******************************************Main Categories Routes*******************************
    Route::group(['prefix'=>'main_categories'],function (){

        Route::get('/', 'MainCategoriesController@index')->name('admin.maincategories');
        //Create Routes
        Route::get('create','MainCategoriesController@create')->name('admin.maincategories.create');
        Route::post('save','MainCategoriesController@save')->name('admin.maincategories.save');
        //Update Routes
        Route::get('edit/{id}','MainCategoriesController@edit')->name('admin.maincategories.edit');
        Route::post('update/{id}','MainCategoriesController@update')->name('admin.maincategories.update');
        //Delete
        Route::get('delete/{id}','MainCategoriesController@delete')->name('admin.maincategories.delete');
        Route::get('active/{id}','MainCategoriesController@changeStatus')->name('admin.maincategories.active');



    });

    //*******************************************End Main categories Routes*******************************
    //
    //*******************************************Sub Categories Routes*******************************
    Route::group(['prefix'=>'Subcategories'],function (){

        Route::get('/', 'SubCategoriesController@index')->name('admin.subcategories');
        //Create Routes
        Route::get('create','SubCategoriesController@create')->name('admin.subcategories.create');
        Route::post('save','SubCategoriesController@save')->name('admin.subcategories.save');
        //Update Routes
        Route::get('edit/{id}','SubCategoriesController@edit')->name('admin.subcategories.edit');
        Route::post('update/{id}','SubCategoriesController@update')->name('admin.subcategories.update');
        //Delete
        Route::get('delete/{id}','SubCategoriesController@delete')->name('admin.subcategories.delete');
        Route::get('active/{id}','SubCategoriesController@changeStatus')->name('admin.subcategories.active');



    });

    //*******************************************End Sub categories Routes*******************************

//*******************************************Vendors Routes*******************************
    Route::group(['prefix'=>'vendors'],function (){

        Route::get('/', 'VendorsController@index')->name('admin.vendors');
        //Create Routes
        Route::get('create','VendorsController@create')->name('admin.vendors.create');
        Route::post('save','VendorsController@save')->name('admin.vendors.save');
        //Update Routes
        Route::get('edit/{id}','VendorsController@edit')->name('admin.vendors.edit');
        Route::post('update/{id}','VendorsController@update')->name('admin.vendors.update');
        //Delete
        Route::get('delete/{id}','VendorsController@delete')->name('admin.vendors.delete');
        Route::get('active/{id}','VendorsController@changeStatus')->name('admin.vendors.active');


    });

    //*******************************************End Vendors Routes*******************************

});

Route::get('test',function (){
    return show_name();
});



