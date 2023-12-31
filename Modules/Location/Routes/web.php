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
    Route::get('location', 'LocationController@index')->name('location');
    Route::group(['prefix' => 'location', 'as'=>'location.'], function () {
        Route::post('datatable-data', 'LocationController@get_datatable_data')->name('datatable.data');
        Route::post('store-or-update', 'LocationController@store_or_update_data')->name('store.or.update');
        Route::post('show', 'LocationController@show')->name('show');
        Route::post('edit', 'LocationController@edit')->name('edit');
        Route::post('delete', 'LocationController@delete')->name('delete');
        Route::post('bulk-delete', 'LocationController@bulk_delete')->name('bulk.delete');
        Route::post('change-status', 'LocationController@change_status')->name('change.status');
    });
});
