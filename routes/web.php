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

use \App\Http\Middleware\CheckAdmin;

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/form-review', 'FormReviewController@index');
Route::post('/form-review', 'FormReviewController@store');

Route::middleware(CheckAdmin::class)->prefix('admin')->group(function() {
    Route::get('/', 'AdminController@index');
    Route::get('users', 'AdminUsersController@index');
    Route::post('users', 'AdminUsersController@store');
    Route::get('reviews', 'AdminReviewsController@index');
    Route::post('reviews', 'AdminReviewsController@store');
    Route::delete('reviews/{id}', 'AdminReviewsController@delete');
});
