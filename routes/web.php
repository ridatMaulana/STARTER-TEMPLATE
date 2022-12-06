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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Auth::routes();

// Route::get('/home', function() {
//     return view('home');
// })->name('home')

Route::get('admin/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home')
    ->middleware('is_admin');

Route::get('admin/buku', [App\Http\Controllers\AdminController::class, 'book'])->name('admin.book')->middleware('is_admin');

Route::post('admin/buku', [App\Http\Controllers\AdminController::class, 'create'])->name('admin.book.submit')->middleware('is_admin');
Route::patch('admin/buku/update', [App\Http\Controllers\AdminController::class, 'update'])->name('book.update')->middleware('is_admin');

