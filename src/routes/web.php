<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

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

Route::get('/', [ContactController::class, 'index'])
    ->name('contact.index');
Route::post('/confirm', [ContactController::class, 'confirm'])
    ->name('contact.confirm');
Route::post('/contact/back', [ContactController::class, 'back'])
    ->name('contact.back');
Route::post('/contact/store', [ContactController::class, 'store'])
    ->name('contact.store');
Route::get('/thanks', [ContactController::class, 'thanks'])
    ->name('contact.thanks');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])
        ->name('admin.index');

    Route::delete('/{contact}', [AdminController::class, 'destroy'])
        ->name('admin.destroy');

    Route::get('/export', [AdminController::class, 'export'])
        ->name('admin.export');
});

