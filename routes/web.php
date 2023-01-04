<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashBoardController;

// Login Routes...
Route::group(['controller' => LoginController::class], function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
});

// Logout Routes...
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes...
Route::group(['controller' => RegisterController::class], function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
});

// Password Reset Routes...
Route::group(
    ['controller' => ForgotPasswordController::class], 
    function () {
        Route::get('/password/reset', 'showLinkRequestForm')
            ->name('password.request');
        Route::post('/password/email', 'sendResetLinkEmail')
            ->name('password.email');
        Route::get('/password/reset/{token}', 'showResetForm')
            ->name('password.reset');
        Route::post('/password/reset', 'reset')->name('password.update');
    }
);

// Password Confirmation Routes...
Route::group(
    ['controller' => ConfirmPasswordController::class], 
    function () {
    Route::get('/password/confirm', 'showConfirmForm')
        ->name('password.confirm');
    Route::post('/password/confirm', 'confirm');
    }
);         

// Email Verification Routes...
Route::group(['controller' => VerificationController::class], function () {
    Route::get('/email/verify', 'show')
        ->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')
        ->name('verification.verify');
    Route::post('/email/resend', 'resend')
        ->name('verification.resend');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/product/{product}', [ProductController::class, 'viewProduct'])
    ->name('product');

Route::get(
    '/category/{category}/products', 
    [CategoryController::class, 'viewCategoryProducts']
)->name('category.products');

Route::get('/cart', function () {
    return view('cart.cartPage');
})->middleware('auth');

Route::group(
    ['prefix' => 'dashboard', 'middleware' => 'auth', 'controller' => DashBoardController::class], 
    function () {
        Route::get('/products', 'viewTableProduct')
            ->name('dashboard.products');
        Route::get('/purchases', 'viewTablePurchases')
            ->name('dashboard.purchases');
        Route::get('/categories', 'viewTableCategories')
            ->name('dashboard.categories');
        Route::get('/users', 'viewTableUsers')
            ->name('dashboard.users');
    }
);