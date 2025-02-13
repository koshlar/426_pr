<?php

use App\Http\Controllers\CartProductController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegLogController;
use App\Models\CartProduct;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  return view('pages.home');
})->name('home');

Route::controller(RegLogController::class)
  ->group(function () {
    Route::middleware('guest')
      ->group(function () {
        Route::get('/login', 'edit');
        Route::post('/login', 'login')->name('login');

        Route::get('/register', 'create');
        Route::post('/register', 'register')->name('register');
      });
    Route::middleware('auth')
      ->group(function () {
        Route::post('/logout', 'logout')->name('logout');
      });
  });

Route::resource('products', ProductController::class)
  ->except('index', 'show')
  ->middleware('admin');

Route::controller(ProductController::class)
  ->prefix('/products')
  ->group(function () {
    Route::get('/', 'index')->name('products.index');
    Route::get('/{product}', 'show')->name('products.show');
  });

Route::resource('categories', ProductCategoryController::class)
  ->except(['show'])
  ->middleware('admin');

Route::controller(CartProductController::class)
  ->middleware('auth')
  ->group(
    function () {
      Route::prefix('cart')->group(function () {
        Route::get('/', 'index')->name('cart.index');
        Route::post('/', 'store')->name('cart.store');
        Route::patch('/add', 'add')->name('cart.add');
        Route::patch('/remove', 'remove')->name('cart.remove');
      });
    }
  );

  // Route::prefix('orders')->group(function() {
  //   Route::get('/', 'index')->name('orders.index');
  //   Route::post('/', 'store')->name('orders.status.change');
  // });
