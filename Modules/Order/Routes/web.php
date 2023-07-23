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

Route::group(['middleware' => ['auth']], function () {
    Route::get('order', 'OrderController@index')->name('order');
    Route::group(['prefix' => 'order', 'as'=>'order.'], function () {
        Route::post('datatable-data', 'OrderController@get_datatable_data')->name('datatable.data');
        Route::post('store-or-update', 'OrderController@store_or_update_data')->name('store.or.update');
        Route::post('edit', 'OrderController@edit')->name('edit');
        Route::post('delete', 'OrderController@delete')->name('delete');
        Route::post('bulk-delete', 'OrderController@bulk_delete')->name('bulk.delete');
        Route::post('change-status', 'OrderController@change_status')->name('change.status');
    });
});
