<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

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


Route::get('/', [ProductoController::class,'index'])->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get("/carrito",function(){
    return view("carrito");
})->name("carrito");
Route::put('/producto/show/{id}', [ProductoController::class, 'update'])->name('update')->middleware('auth');
Route::get('/producto/create', [ProductoController::class, 'create'])->name('create')->middleware('auth');
Route::post('/producto/create', [ProductoController::class, 'store'])->name('store')->middleware('auth');
Route::get('/producto/show/{id}', [ProductoController::class, 'show'])->name('show')->middleware('auth');
