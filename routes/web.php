<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;

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

Route::get('/dashboard', [CompanyController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Route::middleware(['auth'])->prefix('company')->group(function () {
//     Route::get('/create', [CompanyController::class, 'create'])->name('company.create');
//     Route::post('/create', [CompanyController::class, 'store'])->name('company.store');
//     Route::get('/{id}/edit', [CompanyController::class, 'edit'])->name('company.edit');
//     Route::post('/{id}/edit', [CompanyController::class, 'update'])->name('company.update');
// });

Route::resource('company', CompanyController::class)->middleware(['auth']);

require __DIR__.'/auth.php';
