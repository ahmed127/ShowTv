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



Route::group([
    'prefix' => 'adminPanel',
    'namespace' => 'App\Http\Controllers\AdminPanel',
    'as' => 'adminPanel.'],
    function () {

    Route::group(['middleware' => ['guest']], function () {

        Route::get('/login', 'AuthController@login')->name('login');
        Route::post('/login', 'AuthController@postLogin')->name('postLogin');
    });

    Route::group(['middleware' => ['auth:admin', 'permissionHandler']], function () {

        Route::get('logout', 'AuthController@logout')->name('logout');

        Route::get('/', function () {
            return view('welcome');
        })->name('dashboard');

        Route::resource('roles', 'RoleController');
        Route::get('updatePermissions', 'RoleController@updatePermissions')->name('roles.updatePermissions');

        Route::resource('admins', AdminController::class);

        Route::resource('shows', ShowController::class );
        Route::resource('shows.episodes', EpisodeController::class )->shallow();

        Route::get('/users', 'UserController@index')->name('users.index');
    });
});

Route::group([
    'namespace' => 'App\Http\Controllers\Site',
    'as' => 'site.'],
    function () {

    Route::group(['middleware' => ['guest']], function () {

        Route::get('/login', 'AuthController@login')->name('login');
        Route::post('/login', 'AuthController@postLogin')->name('postLogin');
        Route::get('/register', 'AuthController@register')->name('register');
        Route::post('/register', 'AuthController@postRegister')->name('postRegister');
    });

    Route::group(['middleware' => ['auth']], function () {

        Route::get('logout', 'AuthController@logout')->name('logout');

        Route::get('/search', 'MainController@search')->name('search');
        Route::get('/', 'MainController@home')->name('home');

        Route::get('/purchase', 'MainController@purchase')->name('purchase');
        Route::get('/purchase-show/{id}', 'MainController@purchase_show')->name('purchase_show');
        Route::get('/wallet', 'MainController@wallet')->name('wallet');
        Route::post('/charge-wallet', 'MainController@charge_wallet')->name('charge_wallet');

        Route::get('/profile', 'MainController@profile')->name('profile');
        Route::post('/update-profile', 'MainController@update_profile')->name('update_profile');
        Route::post('/update-password', 'MainController@update_password')->name('update_password');
        Route::get('/follow/{id}', 'MainController@follow')->name('follow');
        Route::get('/unfollow/{id}', 'MainController@unfollow')->name('unfollow');

        Route::get('/show/{id}', 'MainController@show')->name('show');
        Route::get('/episode/{id}', 'MainController@episode')->name('episode');
        Route::get('/like/{id}', 'MainController@like')->name('like');
        Route::get('/dislike/{id}', 'MainController@dislike')->name('dislike');
    });
});
