<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::post('/sales/store', [SaleController::class, 'store']);


    // SALES
    Route::get('/sales', [SaleController::class, 'index']);

    // POS
    Route::get('/sales/create', [SaleController::class, 'create']);

});Route::get('/sales/{id}/receipt',
    [SaleController::class, 'receipt']);
Route::middleware(['auth', 'role:admin'])->group(function () {
Route::get('/users', [UserController::class, 'index']);

Route::get('/users/create', [UserController::class, 'create']);

Route::post('/users/store', [UserController::class, 'store']);
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products',
    [ProductController::class, 'index']);

Route::get('/products/create',
    [ProductController::class, 'create']);

Route::post('/products/store',
    [ProductController::class, 'store']);

Route::get('/suppliers', [SupplierController::class, 'index']);
Route::get('/suppliers/create', [SupplierController::class, 'create']);
Route::post('/suppliers/store', [SupplierController::class, 'store']);
Route::get('/purchases',
    [PurchaseController::class, 'index']);

Route::get('/purchases/create',
    [PurchaseController::class, 'create']);

Route::post('/purchases/store',
    [PurchaseController::class, 'store']);
    Route::get('/products/{id}/edit',
    [ProductController::class, 'edit']);

Route::put('/products/{id}',
    [ProductController::class, 'update']);

Route::delete('/products/{id}',
    [ProductController::class, 'destroy']);
});


Route::get('/sales/{id}/pdf',
    [SaleController::class, 'pdf']);