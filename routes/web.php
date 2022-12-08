<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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

Route::get('admin/home', [AdminController::class, 'index'])->name('admin.home')
    ->middleware('is_admin');

Route::get('admin/buku', [AdminController::class, 'book'])->name('admin.book')->middleware('is_admin');
Route::get('/ajax/databuku/{id}', [AdminController::class, 'searchBook'])->middleware('is_admin');

Route::post('admin/buku', [AdminController::class, 'create'])->name('admin.book.submit')->middleware('is_admin');
Route::patch('admin/buku/update', [AdminController::class, 'update'])->name('book.update')->middleware('is_admin');

Route::post('buku/hapus/{id}',[AdminController::class, 'destroy'])->name('book.delete')->middleware('is_admin');

Route::get('admin/print_books',[AdminController::class,'print_books'])->name('books.print')->middleware('is_admin');

Route::get('admin/export_excel',[AdminController::class,'export'])->name('books.excel.export')->middleware('is_admin');

Route::post('admin/import_excel',[AdminController::class,'import'])->name('books.excel.import')->middleware('is_admin');
