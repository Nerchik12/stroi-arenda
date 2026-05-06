<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\WhyController::class, 'index'])->name('index');
Route::get('/why', [App\Http\Controllers\WhyController::class, 'why'])->name('why');
Route::get('/catalog', [App\Http\Controllers\CatalogController::class, 'catalog'])->name('catalog');
Route::get('/map', [App\Http\Controllers\MapController::class, 'map'])->name('map');
Route::post('/sendFeedback', [App\Http\Controllers\MapController::class, 'sendFeedback'])->name('sendFeedback');
Route::get('/product/{id}', [App\Http\Controllers\ProductController::class, 'product'])->name('product');
Route::post('/product/{id}/review', [App\Http\Controllers\ProductController::class, 'addReview'])->name('product.review');
Route::get('/cart', [App\Http\Controllers\CartController::class, 'cart'])->name('cart');
Route::post('/buscket', [App\Http\Controllers\CartController::class, 'add'])->name('add_buscket');
Route::post('/remove', [App\Http\Controllers\CartController::class, 'remove'])->name('remove');
Route::post('/remove_add', [App\Http\Controllers\CartController::class, 'remove_add'])->name('remove_add');
Route::get('/add_product', [App\Http\Controllers\AddProductController::class, 'add_product'])->name('add_product');
Route::post('/add_img', [App\Http\Controllers\AddProductController::class, 'img'])->name('img');
Route::get('/orders', [App\Http\Controllers\OrdersController::class, 'orders'])->name('orders');
Route::get('/add_order', [App\Http\Controllers\CartController::class, 'add_order'])->name('add_order');

// ВАЖНО: Этот маршрут должен быть именно POST и не конфликтовать с другими
Route::post('/remove_orders', [App\Http\Controllers\OrdersController::class, 'removeOrders'])->name('removeOrders');

Route::get('/filter', [App\Http\Controllers\CatalogController::class, 'filter'])->name('filter');
Route::get('/sendReviews', [App\Http\Controllers\ReviewController::class, 'sendReviews'])->name('sendReviews');
Route::post('/sendReview', [App\Http\Controllers\ReviewController::class, 'sendReview'])->name('sendReview');
Route::post('/update-quantity', [App\Http\Controllers\CartController::class, 'updateQuantity'])->name('update.quantity');
Route::post('/update-rental-days', [App\Http\Controllers\CartController::class, 'updateRentalDays'])->name('update.rental_days');

// API для корзины
Route::get('/api/cart/count', [App\Http\Controllers\ApiCartController::class, 'count']);

// =================================================================
// АДМИН-ПАНЕЛЬ
// =================================================================
Route::middleware(['auth', 'is.admin'])->prefix('admin')->name('admin.')->group(function () {
    // Главная
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('index');

    // Пользователи
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('users');
    Route::post('/users/{id}/make-admin', [App\Http\Controllers\AdminController::class, 'makeAdmin'])->name('users.make-admin');
    Route::post('/users/{id}/make-user', [App\Http\Controllers\AdminController::class, 'makeUser'])->name('users.make-user');
    Route::post('/users/{id}/reset-password', [App\Http\Controllers\AdminController::class, 'resetPassword'])->name('users.reset-password');
    Route::delete('/users/{id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('users.delete');

    // Отзывы
    Route::get('/reviews', [App\Http\Controllers\AdminController::class, 'reviews'])->name('reviews');
    Route::delete('/reviews/{id}', [App\Http\Controllers\AdminController::class, 'deleteReview'])->name('reviews.delete');

    // Заказы
    Route::get('/orders', [App\Http\Controllers\AdminController::class, 'orders'])->name('orders');
    Route::post('/orders/{id}/status', [App\Http\Controllers\AdminController::class, 'updateOrderStatus'])->name('orders.update-status');

    // Товары
    Route::get('/products', [App\Http\Controllers\AdminController::class, 'products'])->name('products');
    Route::get('/products/{id}/edit', [App\Http\Controllers\AdminController::class, 'editProduct'])->name('products.edit');
    Route::post('/products/{id}/update', [App\Http\Controllers\AdminController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{id}', [App\Http\Controllers\AdminController::class, 'deleteProduct'])->name('products.delete');
});


