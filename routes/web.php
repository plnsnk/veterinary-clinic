<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
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
/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/', [UserController::class, 'index']);
Route::get('/test', fn() => view('test'));

// Аутентификация
Route::get('/register', [UserController::class, 'registerForm']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/auth', [UserController::class, 'authForm'])->name('login');
Route::post('/auth', [UserController::class, 'auth']);
Route::get('/logout', [UserController::class, 'logout']);

// Контент, справочники и страницы животных
Route::get('/privacy', [MainController::class, 'privacy']);
Route::get('/search', [MainController::class, 'search']);
Route::get('/all-services', [MainController::class, 'allServices'])->name('services.all');
Route::get('/service/{service}', [MainController::class, 'serviceShow']);
Route::get('/products', [MainController::class, 'products']);
Route::get('/gratitude', [UserController::class, 'gratitude']);
Route::get('/application', [MainController::class, 'application'])->name('application');

Route::get('/animal/cats', fn() => view('animal.cats'));
Route::get('/animal/dogs', fn() => view('animal.dogs'));
Route::get('/animal/guinea_pigs', fn() => view('animal.guinea_pigs'));
Route::get('/animal/parrot', fn() => view('animal.parrot'));
Route::get('/animal/rabbit', fn() => view('animal.rabbit'));


// Route::get('/category', [CategoryController::class, 'index']);
// Route::get('/product', [ProductController::class, 'index']);
// Route::get('/service', [ServiceController::class, 'index']);

/*
авторизованные пользователи
*/
Route::middleware(['auth'])->group(function () {
    // Личный кабинет и профиль
    Route::get('/cabinet', [UserController::class, 'cabinet']);
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/photo', [UserController::class, 'updatePhoto'])->name('profile.photo.update');

    // Формы и отправка данных
    Route::get('/formAnimal', [UserController::class, 'formAnimal']);
    Route::post('/formAnimal', [UserController::class, 'animal']);
    Route::get('/formAsk', [UserController::class, 'formAsk']);
    Route::post('/formAsk', [UserController::class, 'ask']);
    Route::get('/formReview', [UserController::class, 'formReview']);
    Route::post('/formReview', [UserController::class, 'review']);
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::post('/storeApp', [MainController::class, 'storeApp']);
    Route::post('/status', [UserController::class, 'status']);

    // // API для записи
    // Route::get('/api/services', [UserController::class, 'getServices']);
    // Route::get('/api/time-slots', [UserController::class, 'getTimeSlots']);

    // Корзина и заказы
    Route::get('/view', [UserController::class, 'view']);
    Route::get('/view/add/{id}', [CartController::class, 'add']);
    Route::post('/cart/plus/{id}', [CartController::class, 'plus'])->name('cart.plus');
    Route::post('/cart/minus/{id}', [CartController::class, 'minus'])->name('cart.minus');
    Route::post('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/cart/order', [UserController::class, 'order']);
    Route::post('/create', [UserController::class, 'create']);
    Route::get('/orders', [UserController::class, 'orders']);

    // Личные списки
    Route::get('/animal', [UserController::class, 'animals']);
    Route::get('/reviews', [UserController::class, 'reviews']);
    Route::get('/asks', [UserController::class, 'asks']);
});

/*
admin
*/
Route::middleware(['auth', 'admin'])->group(function () {
    // Модерация отзывов и вопросов
    Route::get('/admin/feedback', [AdminController::class, 'admin_feedback']);
    Route::post('/admin/review/{id}/toggle', [AdminController::class, 'toggleReviewStatus'])->name('admin.review.toggle');
    Route::post('/admin/review/{id}/approve', [AdminController::class, 'approveReview']);
    Route::get('/admin/ask', [AdminController::class, 'admin_ask']);
    Route::post('/admin/ask_account', [AdminController::class, 'ask_account']);
    Route::get('/admin/ask/{id}/answer', [AdminController::class, 'showAnswerForm'])->name('admin.ask.answer.form');
    Route::post('/admin/ask/{id}/answer', [AdminController::class, 'saveAnswer'])->name('admin.ask.answer.save');
    Route::post('/admin/question/{id}/toggle', [AdminController::class, 'toggleQuestionStatus'])->name('admin.question.toggle');

    // Управление заказами
    Route::get('/admin/orders', [AdminController::class, 'orders']);
    Route::post('/admin/orders/{id}/status', [AdminController::class, 'updateStatus']);

Route::get('/category', [\App\Http\Controllers\CategoryController::class, 'index']);
Route::get('/categories/store', [\App\Http\Controllers\CategoryController::class, 'categoryForm']);
Route::post('/categories/store', [\App\Http\Controllers\CategoryController::class, 'category']);
Route::get('/categories/edit/{id}', [\App\Http\Controllers\CategoryController::class, 'categoryEdit']);
Route::post('/categories/edit/{id}', [\App\Http\Controllers\CategoryController::class, 'categoryUpdate']);
Route::post('/categories/destroy/{id}', [\App\Http\Controllers\CategoryController::class, 'categoryDestroy']);
// Продукты
Route::get('/product', [\App\Http\Controllers\ProductController::class, 'index']);
Route::get('/product/store', [\App\Http\Controllers\ProductController::class, 'productForm']);
Route::post('/product/store', [\App\Http\Controllers\ProductController::class, 'productCreate']);
Route::get('/product/edit/{id}', [\App\Http\Controllers\ProductController::class, 'productEdit']);
Route::post('/product/update/{id}', [\App\Http\Controllers\ProductController::class, 'productUpdate']);
Route::post('/product/destroy/{id}', [\App\Http\Controllers\ProductController::class, 'productDestroy']);
// Услуги
Route::get('/service', [\App\Http\Controllers\ServiceController::class, 'index']);
Route::get('/services/store', [\App\Http\Controllers\ServiceController::class, 'serviceForm']);
Route::post('/service/store', [\App\Http\Controllers\ServiceController::class, 'serviceCreate']);
Route::get('/service/edit/{id}', [\App\Http\Controllers\ServiceController::class, 'serviceEdit']);
Route::post('/service/update/{id}', [\App\Http\Controllers\ServiceController::class, 'serviceUpdate']);
Route::post('/service/destroy/{id}', [\App\Http\Controllers\ServiceController::class, 'serviceDestroy']);

});
// Route::get('/animal/dogs', function() {    return view('animal.dogs');});
// Route::get('/animal/guinea_pigs', function() { return view('animal.guinea_pigs');});
// Route::get('/animal/parrot', function() {    return view('animal.parrot');});
// Route::get('/animal/rabbit', function() {    return view('animal.rabbit');});