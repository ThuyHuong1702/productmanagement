<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::resource('products', ProductController::class);
//thêm
use App\Http\Controllers\Admin\ProductController;

Route::post('/admin/products/store', [ProductController::class, 'store']);

