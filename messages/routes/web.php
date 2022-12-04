<?php

use Illuminate\Support\Facades\Auth;
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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['namespace' => 'App\Http\Controllers'], function() {

    Route::group(['namespace' => 'Message'], function () {
        Route::group(['middleware' => ['auth']], function() {
            Route::post('/parent_create', 'ParentMessageController@create')->name('parent_messages_create');
            Route::post('/parent_delete/{id}', 'ParentMessageController@delete')->name('parent_messages_delete');

            Route::post('/child_create', 'ChildMessageController@create')->name('child_messages_create');
            Route::post('/child_delete/{id}', 'ChildMessageController@delete')->name('child_messages_delete');
        });
    });

    Route::group(['namespace' => 'Like'], function () {
        Route::group(['middleware' => ['auth']], function() {
             Route::post('/like_message', 'LikeController@create')->name('like_messages_create');
             Route::post('/delete_like_message', 'LikeController@delete')->name('like_messages_delete');
        });
    });
});
