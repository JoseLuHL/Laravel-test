<?php

use Illuminate\Support\Facades\Http;
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

Route::get('/', function () {
	$resCategory= Http::get('http://192.168.1.4:8081/api/categories');
	$categorias = $resCategory->json();
    return view('welcome',['categories'=>$categorias]);
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::view('home', 'home');

//Route Hooks - Do not delete//
	Route::view('categories', 'livewire.categories.index')->middleware('auth');
	Route::view('products', 'livewire.products.index')->middleware('auth');
	Route::view('products', 'livewire.products.index');
	Route::view('categories', 'livewire.categories.index');