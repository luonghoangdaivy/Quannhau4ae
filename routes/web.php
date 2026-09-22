<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\WaiterController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// TRANG CHỦ
Route::get('/', fn() => redirect()->route('trangchu'));
Route::get('/trangchu', [HomeController::class, 'index'])->name('trangchu');


// ĐĂNG KÝ
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [UserController::class, 'register'])->name('user.register');

// ĐĂNG NHẬP
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [UserController::class, 'login'])->name('login');

// ĐĂNG XUẤT
Route::get('/logout', [UserController::class, 'logout'])->name('logout');


// MENU
Route::get('/menu', [ProductController::class, 'index'])->name('menu.index');
Route::get('/menu/search', [ProductController::class,'search'])->name('menu.search');
Route::get('/menu/{id}', [ProductController::class, 'show'])->name('menu.show');


// CART
Route::post('/cart/add', [CartController::class,'add'])->name('cart.add');
Route::get('/cart/dropdown', [CartController::class,'dropdown'])->name('cart.dropdown');
Route::get('/cart', [CartController::class,'index'])->name('cart.index');
Route::post('/cart/update', [CartController::class,'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class,'remove'])->name('cart.remove');
Route::post('/cart/checkout', [CartController::class,'checkout'])->name('cart.checkout');

// ĐẶT BÀN
Route::get('/dat-ban', [ReservationController::class, 'create'])->name('reservation.create');
Route::post('/dat-ban', [ReservationController::class, 'store'])->name('reservation.store');

Route::get('/dat-ban/success', function () {
    return view('reservations.success');
})->name('reservation.success');

Route::get('/dat-ban/thanh-cong', function () {
    return view('reservations.success');
})->name('reservation.success');

// PROFILE
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    Route::get('/change-password', [UserController::class, 'changePasswordForm'])->name('change.password');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('change.password.post');

    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])
        ->name('profile.changePassword');
});


// ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/', fn() => redirect()->route('admin.product.index'));

    Route::get('/products', [AdminProductController::class, 'index'])->name('admin.product.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin.product.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('admin.product.store');
    Route::get('/products/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('/products/{id}', [AdminProductController::class, 'update'])->name('admin.product.update');
    Route::delete('/products/{id}', [AdminProductController::class, 'destroy'])->name('admin.product.destroy');
});

// Thêm vào routes/web.php
Route::get('/khuyen-mai', [App\Http\Controllers\PromotionController::class, 'index'])->name('promotions.index');
Route::get('/uu-dai', [App\Http\Controllers\PromotionController::class, 'index']); // Route thay thế


Route::prefix('kitchen')->middleware('auth')->group(function () {
    Route::get('/', [KitchenController::class, 'index'])->name('kitchen.index');
    Route::post('/status/{id}', [KitchenController::class, 'updateStatus'])->name('kitchen.updateStatus');
});

Route::prefix('waiter')->middleware('auth')->group(function () {
    Route::get('/', [WaiterController::class, 'index'])->name('waiter.index');
});