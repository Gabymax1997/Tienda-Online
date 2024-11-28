<?php

use App\Http\Controllers\ProfileController;
use App\Models\articulos;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\RegisterController;





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
    return view('template');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
//asignar valores
Route::get('prueba', function(){
$art=new articulos;
$art->nombre ='Titulo de prueba 1';
$art->descripcion='Contenido de prueba 1';
$art->precio=100.00;

$art ->save();
return $art;
});

// routes/web.php



Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
//Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
//Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
//Route::get('/products', [ProductController::class, 'index'])->name('products.index');
//Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
//Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{productName}', [CartController::class, 'add'])->name('cart.add');
// Ruta para vaciar el carrito
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/payment', [CartController::class, 'processPayment'])->name('payment.process');
Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
require __DIR__.'/auth.php';
