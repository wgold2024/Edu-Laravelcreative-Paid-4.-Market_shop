<?php


use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\ParamController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGroupController;
use App\Http\Middleware\IsAdminMiddleWare;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->prefix('admin')->middleware(['auth', IsAdminMiddleWare::class]);

Route::prefix('admin')->name('admin.')->middleware(['auth', IsAdminMiddleWare::class])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('product-groups', ProductGroupController::class)->parameters(['product-groups' => 'productGroup']);
    Route::resource('params', ParamController::class);
    Route::resource('categories', CategoryController::class);

    Route::get('/product/{product}/children', [ProductController::class, 'indexChild'])->name('products.children.index');
    Route::get('/product/{product}/children/create', [ProductController::class, 'createChild'])->name('products.children.create');

    Route::delete('image/{image}', [ImageController::class, 'destroy'])->name('images.destroy');

    //Route::get('product-parents', [ProductGroupController::class, 'index'])->name('product_parents.index');
});
