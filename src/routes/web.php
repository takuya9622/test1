<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
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

Route::get('/', [ContactController::class, 'index']);

Route::post('/confirm',[ContactController::class, 'confirm']);
Route::get('/confirm', function() {
    return redirect('/');
});

Route::get('/thanks', [ContactController::class, 'thanks']);
Route::post('/thanks', [ContactController::class, 'store']);


Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/search', [AdminController::class, 'search']);
    Route::get('/admin/export', [AdminController::class, 'exportCsv'])->name('admin.export');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
});