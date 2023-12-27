<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/home', 'home')->name('home');
});

Route::controller(MessageController::class)->group(function() {
    Route::get('/messages', 'index')->name('message.index');
    Route::get('/messages/selectAll', 'selectAll')->name('message.selectAll');
    Route::get('/messages/create', 'create')->name('message.create');
    Route::post('/messages/store', 'store')->name('message.store');
    Route::get('/messages/show/{id}', 'show')->name('message.show');
    Route::get('/messages/edit/{id}', 'edit')->name('message.edit');
    Route::post('/messages/update/{id}', 'update')->name('message.update');
    Route::get('/messages/reply/{id}', 'reply')->name('message.reply');
    Route::post('/messages/updateReply/{id}', 'updateReply')->name('message.updateReply');
    Route::get('/messages/show/{id}', 'show')->name('message.show');
    Route::get('/messages/destroy/{id}', 'destroy')->name('message.destroy');
});

Route::middleware(['auth'])->group(function () {

    Route::controller(HomeController::class)->group(function() {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
    });    

    Route::controller(UserController::class)->group(function() {
        Route::get('/users', 'index')->name('user.index');
        Route::get('/users/selectAll', 'selectAll')->name('user.selectAll');
        Route::get('/users/create', 'create')->name('user.create');
        Route::post('/users/store', 'store')->name('user.store');
        Route::get('/users/edit/{id}', 'edit')->name('user.edit');
        Route::post('/users/update/{id}', 'update')->name('user.update');
        Route::get('/users/show/{id}', 'show')->name('user.show');
        Route::delete('/users/destroy/{id}', 'destroy')->name('user.destroy'); 
    });

});
