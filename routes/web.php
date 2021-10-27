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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user/list', [App\Http\Controllers\UserController::class, 'list'])->name('user_list');
Route::get('/user/dashboard/{id}', [App\Http\Controllers\UserController::class, 'dashboard'])->name('user_dashboard');
Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user_edit');
Route::put('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user_update');

Route::get('/notification/dashboard', [App\Http\Controllers\NotificationController::class, 'index'])->name('notification_dashboard');
Route::get('/notification/create', [App\Http\Controllers\NotificationController::class, 'create'])->name('create_notification');
Route::post('/notification/send', [App\Http\Controllers\NotificationController::class, 'send'])->name('send_notification');
Route::get('/notification/markasread', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notification_mark_as_read');
