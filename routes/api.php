<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CartController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'auth'], function ($router) {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class,'login']);
    Route::get('dashboard', [DashboardController::class, 'showDashboardForm'])->name('dashboard');
    Route::get('admin-dashboard', [AdminDashboardController::class, 'showAdminDashboardForm'])->name('admin-dashboard');
    Route::get('user-register', [AuthController::class, 'showRegistrationForm'])->name('user-register');
    Route::get('admin-register', [AuthController::class, 'showAdminRegistrationForm'])->name('admin-register');
    Route::get('all-products', [ProductsController::class, 'showAllProducts'])->name('all-products');
    Route::get('user-all-products', [ProductsController::class, 'showAllProductsUser'])->name('user-all-products');
    Route::get('user-cart', [CartController::class,'showUserCart'])->name('user-cart');


    Route::post('user-register', [AuthController::class,'register']);
    Route::post('admin-register', [AuthController::class,'register']);
    Route::get('admin-products', [ProductsController::class, 'showAdminProducts'])->name('admin-products');
    Route::post('admin-products', [ProductsController::class,'admin-products']);
    Route::get('add-products', [ProductsController::class, 'showAddProducts'])->name('add-products');
    Route::get('/details-show/{product_id}', [ProductsController::class, 'showUpdateProduct'])->name('update-products');
    Route::get('/products/update/{id}', 'ProductController@edit')->name('product.edit');
    Route::post('/update/{product_id}', [ProductsController::class, 'update']);
    Route::delete('/delete/{product_id}', [ProductsController::class, 'delete']);
    Route::get('/details/{product_id}', [ProductsController::class, 'getProductDetails']);
})->middleware('auth:sanctum');

Route::middleware(['auth:api'])->group(function(){
    Route::post('/product/store', [ProductsController::class,'add'])->name('product.store');;
    Route::post('/cart', [CartController::class,'addToCart']);
    Route::post('/remove', [CartController::class,'removeFromCart']);
    Route::get('/all-cart', [CartController::class,'getCartItems']);
    Route::post('me', [AuthController::class,'me']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::get('view-all-products', [ProductsController::class,'viewAllProducts']);
})->middleware('auth:sanctum');



