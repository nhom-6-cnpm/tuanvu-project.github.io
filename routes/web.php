<?php

use App\Http\Controllers\Admin\CampingController;
use App\Http\Controllers\Admin\CartController as AdminCartController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\MainController as ControllersMainController;
use App\Http\Controllers\MenuController as ControllersMenuController;
use App\Http\Controllers\ProductController as ControllersProductController;
use Illuminate\Support\Facades\Route;

# Routes cho authentication
Route::get('/login', [LoginController::class, 'userLogin'])->name('user.login');
Route::post('/login', [LoginController::class, 'userStore']);
Route::get('/register', [LoginController::class, 'userRegister'])->name('user.register');
Route::post('/register', [LoginController::class, 'createAccount'])->name('user.register.store');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

# Routes cho admin authentication
Route::get('admin/users/login', [LoginController::class, 'index'])->name('admin.login');
Route::post('admin/users/login/store', [LoginController::class, 'store']);
Route::post('admin/logout', [LoginController::class, 'adminLogout'])->name('admin.logout');

Route::middleware(['auth', 'admin'])->group(function(){
    
    Route::prefix('admin')->group(function() {
        
        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('/main', [MainController::class, 'index']);

        #Menu
        Route::prefix('menus')->group(function() {
            Route::get('add', [MenuController::class, 'create']);
            Route::post('add', [MenuController::class, 'store'])->name('menus-add');
            Route::get('list', [MenuController::class, 'index']);
            Route::get('edit/{menu}', [MenuController::class, 'show']);
            Route::post('edit/{menu}', [MenuController::class, 'update']);
            Route::DELETE('destroy', [MenuController::class, 'destroy']);
        });

        #Product
        Route::prefix('products')->group(function() {
            Route::get('add', [ProductController::class, 'create']);
            Route::post('add', [ProductController::class, 'store']);
            Route::get('list', [ProductController::class, 'index']);
            Route::get('edit/{product}', [ProductController::class, 'show']);
            Route::post('edit/{product}', [ProductController::class, 'update']);
            Route::DELETE('destroy', [ProductController::class, 'destroy']);
        });

        #Slider
        Route::prefix('sliders')->group(function() {
            Route::get('add', [SliderController::class, 'create']);
            Route::post('add', [SliderController::class, 'store']);
            Route::get('list', [SliderController::class, 'index']);
            Route::get('edit/{slider}', [SliderController::class, 'show']);
            Route::post('edit/{slider}', [SliderController::class, 'update']);
            Route::DELETE('destroy', [SliderController::class, 'destroy']);
        });

        #Camping
        Route::prefix('campings')->group(function() {
            Route::get('add', [CampingController::class, 'create']);
            Route::post('add', [CampingController::class, 'store']);
            Route::get('list', [CampingController::class, 'index']);
            Route::get('edit/{camping}', [CampingController::class, 'show']);
            Route::post('edit/{camping}', [CampingController::class, 'update']);
            Route::DELETE('destroy', [CampingController::class, 'destroy']);
        });

        #Upload
        Route::post('upload/services', [UploadController::class, 'store']);

        #Cart
        Route::get('customers', [AdminCartController::class, 'index']);
        Route::get('customers/view/{customer}', [AdminCartController::class, 'show']);

        #Contact
        Route::prefix('contacts')->group(function() {
            Route::get('list', [AdminContactController::class, 'list']);
            Route::get('view/{contact}', [AdminContactController::class, 'view']);
            Route::delete('destroy', [AdminContactController::class, 'destroy']);
            Route::post('mark-as-read/{contact}', [AdminContactController::class, 'markAsRead']);
            Route::get('filter', [AdminContactController::class, 'filter']);
        });
    });
});

#Sản Phẩm
Route::get('/', [ControllersMainController::class, 'index']); 
Route::post('/services/load-product', [MainController::class, 'loadProduct']);
Route::get('danh-muc/{id}-{slug}.html', [ControllersMenuController::class, 'index']);
Route::get('san-pham/{id}-{slug}.html', [ControllersProductController::class, 'index']);

#Giỏ Hàng
Route::middleware(['auth'])->group(function () {
    Route::post('add-cart', [CartController::class, 'index']);
    Route::get('carts', [CartController::class, 'show']); 
    Route::post('update-cart', [CartController::class, 'update']);
    Route::get('carts/delete/{id}', [CartController::class, 'remove']); 
    Route::post('carts', [CartController::class, 'order']); 
});

Route::get('contact', [ContactController::class, 'index']);
Route::post('contact/send', [ContactController::class, 'send'])->name('contact.send');

# Thêm route tìm kiếm
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');
