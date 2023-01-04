<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;

/* CATEGORIES */
Route::group(
    ['prefix' => 'categories', 'controller' => CategoryController::class], 
    function () {
        Route::get('/', 'getCategories');
        Route::get('/categoriesWithProducts', 'getCategoriesWithProducts');
        Route::get(
            '/categoryWithProducts/{category}', 'getCategoryWithProducts'
        );
        Route::get('/category/{category}', 'getCategory');
        Route::post('/create', 'createCategory');
        Route::put('/update/{category}', 'updateCategory');
        Route::delete('/delete/{category}', 'deleteCategory');
    }
);
/*-/-*/

/* PRODUCTS */
Route::group(
    ['prefix' => 'products', 'controller' => ProductController::class],
    function () {
        Route::get('/', 'products');
        Route::get('/product/{product}', 'getProduct');
        Route::post('/', 'getProducts');
        Route::post('/create', 'createProduct');
        Route::post('/update/{product}', 'updateProduct');
        Route::delete('/delete/{product}', 'deleteProduct');
    }
);
/*-/-*/

/* PURCHASES */
Route::group(
    ['prefix' => 'purchases', 'controller' => PurchaseController::class], 
    function () {
        Route::get('/', 'getPurchases');
        Route::get('/purchase/{purchase}', 'getPurchase');
        Route::post('/product', 'searchProduct');
        Route::post('/create', 'createPurchase');
        Route::put('/update/{purchase}', 'updatePurchase');
        Route::delete('/delete/{purchase}', 'deletePurchase');
    }
);
/*-/-*/

/* USERS */
Route::group(
    ['prefix' => 'users', 'controller' => UserController::class], 
    function () {
        Route::get('/', 'getUsers');
        Route::get('/user/{user}', 'getUser');
        Route::get('/userPurchases/{user}', 'getUserPurchases');
        Route::get('/roles', 'roles');
        Route::post('/create', 'createUser');
        Route::put('/update/{user}', 'updateUser');
        Route::delete('/delete/{user}', 'deleteUser');
    }
);
/*-/-*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
