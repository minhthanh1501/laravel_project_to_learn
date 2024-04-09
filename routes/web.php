<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleAdminController;
use App\Http\Controllers\SliderAdminController;
use App\Http\Controllers\SettingAdminController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\PermissionAdminController;


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
            ->name('categories.index')->middleware('can:category-list');

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
            ->name('menus.index')->middleware('can:menu-list');

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

        Route::post('/store', [ProductController::class, 'store'])
            ->name('products.store');

        Route::post('/update/{id}', [ProductController::class, 'update'])
            ->name('products.update');

        Route::get('/delete/{id}', [ProductController::class, 'delete'])
            ->name('products.delete');

        Route::get('search', [ProductController::class, 'searchGetProduct'])
            ->name('search');

        // Route::put('/update/{id}', [ProductController::class, 'update'])
        //     ->name('menus.update');
    });

    Route::prefix('sliders')->group(function () {
        Route::get('/', [SliderAdminController::class, 'index'])
            ->name('sliders.index');

        Route::get('/create', [SliderAdminController::class, 'create'])
            ->name('sliders.create');

        Route::get('/edit/{id}', [SliderAdminController::class, 'edit'])
            ->name('sliders.edit');

        Route::get('/delete/{id}', [SliderAdminController::class, 'delete'])
            ->name('sliders.delete');

        Route::post('/store', [SliderAdminController::class, 'store'])
            ->name('sliders.store');

        Route::post('/update/{id}', [SliderAdminController::class, 'update'])
            ->name('sliders.update');
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingAdminController::class, 'index'])
            ->name('settings.index');

        Route::get('/create', [SettingAdminController::class, 'create'])
            ->name('settings.create');

        Route::get('/edit/{id}', [SettingAdminController::class, 'edit'])
            ->name('settings.edit');

        Route::get('/delete/{id}', [SettingAdminController::class, 'delete'])
            ->name('settings.delete');

        Route::post('/store', [SettingAdminController::class, 'store'])
            ->name('settings.store');

        Route::post('/update/{id}', [SettingAdminController::class, 'update'])
            ->name('settings.update');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UserAdminController::class, 'index'])
            ->name('users.index');

        Route::get('/create', [UserAdminController::class, 'create'])
            ->name('users.create');

        Route::get('/edit/{id}', [UserAdminController::class, 'edit'])
            ->name('users.edit');

        Route::get('/delete/{id}', [UserAdminController::class, 'delete'])
            ->name('users.delete');

        Route::post('/store', [UserAdminController::class, 'store'])
            ->name('users.store');

        Route::post('/update/{id}', [UserAdminController::class, 'update'])
            ->name('users.update');
    });

    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleAdminController::class, 'index'])
            ->name('roles.index');

        Route::get('/create', [RoleAdminController::class, 'create'])
            ->name('roles.create');

        Route::get('/edit/{id}', [RoleAdminController::class, 'edit'])
            ->name('roles.edit');

        Route::get('/delete/{id}', [RoleAdminController::class, 'delete'])
            ->name('roles.delete');

        Route::post('/store', [RoleAdminController::class, 'store'])
            ->name('roles.store');

        Route::post('/update/{id}', [RoleAdminController::class, 'update'])
            ->name('roles.update');

        // Route::resource('role', RoleAdminController::class);
    });

    Route::prefix('permissions')->group(function(){
        Route::get('/create', [PermissionAdminController::class,'create'])
        ->name('permissions.create');

        Route::post('/store', [PermissionAdminController::class,'store'])
        ->name('permissions.store');
    });
});
