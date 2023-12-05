<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('uploads/create', [UploadController::class, 'create']);
 Route::get('uploads/index', [UploadController::class, 'index'])->name('uploads.index');
 Route::post('uploads/store', [UploadController::class, 'store'])->name('uploads.store');
Route::get('/uploads/{upload}/{originalName?}/show', [UploadController::class, 'show'])->name('uploads.show');

Route::get('uploads/{id}/edit',[UploadController::class, 'edit']);
Route::put('/uploads/{id}/update', [UploadController::class, 'update'])->name('uploads.update');
// routes/web.php


// Route::get('uploads/{upload}/delete', [UploadController::class, 'showDeleteForm'])->name('uploads.showDeleteForm');
Route::delete('uploads/{id}', [UploadController::class, 'destroy'])->name('uploads.destroy');
//Route::get('/index', [UploadController::class, 'index'])->name('uploads.index');




