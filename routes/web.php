<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
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

Route::get('/admin', [AdminController::class, 'loginAdmin']);
Route::post('/admin', [AdminController::class, 'postLoginAdmin']);

Route::get('/home', function () {
    return view('home');
});

Route::prefix('/admin')->group(function () {
    Route::prefix('categories')->group(function () {

        Route::get('/', [CategoryController::class, 'index'])
            ->name('categories.index');

        Route::get('/create', [CategoryController::class, 'create'])
            ->name('categories.create');

        Route::post('/store', [CategoryController::class, 'store'])
            ->name('categories.store');

        Route::get('/edit/{id}', [CategoryController::class, 'edit'])
            ->name('categories.edit');

        Route::get('/delete/{id}', [CategoryController::class, 'delete'])
            ->name('categories.delete');

        Route::put('/update/{id}', [CategoryController::class, 'update'])
            ->name('categories.update');
    });

    Route::prefix('menus')->group(function () {
        Route::get('/', [MenuController::class, 'index'])
            ->name('menus.index');

        Route::post('/store', [MenuController::class, 'store'])
            ->name('menus.store');

        Route::get('/create', [MenuController::class, 'create'])
            ->name('menus.create');

        Route::get('/edit/{id}', [MenuController::class, 'edit'])
            ->name('menus.edit');

        Route::get('/delete/{id}', [MenuController::class, 'delete'])
            ->name('menus.delete');

        Route::put('/update/{id}', [MenuController::class, 'update'])
            ->name('menus.update');
    });

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])
            ->name('products.index');

        Route::get('/create', [ProductController::class, 'create'])
            ->name('products.create');

        Route::get('/edit/{id}', [ProductController::class, 'edit'])
            ->name('products.edit');

        Route::get('/delete/{id}', [ProductController::class, 'delete'])
            ->name('products.delete');

        Route::post('/store', [ProductController::class, 'store'])
            ->name('products.store');

        Route::get('search', [ProductController::class, 'searchGetProduct'])
            ->name('search');

        // Route::put('/update/{id}', [ProductController::class, 'update'])
        //     ->name('menus.update');
    });
});
