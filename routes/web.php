<?php

use App\Http\Controllers\Main\MainController;
use App\Http\Controllers\NewProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\profile\ProfileController;
use App\Http\Controllers\UserController;
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
    return redirect('/main');
});

Route::get('/main', [MainController::class, 'index'])->name('main');

Route::delete('/delete/{id}', [MainController::class, 'delete']);

Route::get('/register', [MainController::class, 'register']);
Route::post('/registerr', [UserController::class, 'store']);
Route::get('/login', [MainController::class, 'login']);
Route::post('/loginn', [UserController::class, 'auth']);

Route::get('/newproductcomment/{id}', [NewProductController::class, 'commentindex']);
Route::post('/newproductcomment/store/{id}', [NewProductController::class, 'comment']);

Route::get('/productcomment/{id}', [ProductController::class, 'commentindex']);
Route::post('/productcomment/store/{id}', [ProductController::class, 'comment']);

Route::get('/newproducts', [MainController::class, 'newproduct']);

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/admin', [MainController::class, 'index1'])->name('admin');
    Route::get('/product', [ProductController::class, 'index'])->name('products');
    Route::get('/product/add', [ProductController::class, 'create']);
    Route::post('/product/store', [ProductController::class, 'store']);
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{id}', [ProductController::class, 'update']);

    Route::get('/admins', [ProductController::class, 'admin']);
    Route::get('/log', [ProductController::class, 'log']);

    Route::post('/user/role/{id}', [ProductController::class, 'isredactor']);
    Route::post('/user/rolee/{id}', [ProductController::class, 'isnotredactor']);
    Route::post('/user/roleop/{id}', [ProductController::class, 'isoperator']);
    Route::post('/user/roleoop/{id}', [ProductController::class, 'isnotoperator']);

    Route::post('/isactive/{id}', [ProductController::class, 'isactive']);
    Route::post('/isnotactive/{id}', [ProductController::class, 'isnotactive']);

    Route::get('/newproduct', [NewProductController::class, 'index']);
    Route::get('/newproduct/add', [NewProductController::class, 'create']);
    Route::post('/newproduct/store', [NewProductController::class, 'store']);

});

Route::get('/verify/{token}/{email}', [UserController::class, 'verify'])->name('verification.verify');
Route::get('/verify/motice', [UserController::class, 'notice'])->name('verification.notice');

//Profile

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/profile/add', [ProfileController::class, 'create'])->name('profile.add');
Route::post('/profile/store', [ProfileController::class, 'store'])->name('profile.store');
Route::delete('/profile/delete/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('/profile/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');

Route::post('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/password/reset', [UserController::class, 'resetview'])->name('reset');

Route::post('/password', [UserController::class, 'reset'])->name('reset.pass');

Route::get('/password/{token}/{email}', [UserController::class, 'resetpass'])->name('password.reset');

// Route::get('/passwordchange', [UserController::class, 'viewchange']);
Route::post('password/change/{id}', [UserController::class, 'change']);

Route::post('/logout', [UserController::class, 'logout']);
