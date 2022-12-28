<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ProfileController;

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
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
//Route::get('/home',HomeController::class)->name('home');
Route::get('/recipes/{id}/show', [RecipeController::class, 'show'])->name('recipes.show');
Route::get('/users/{id}/show', [UserController::class, 'show'])->name('users.show');
Route::get('/posts/{id}/show', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/store', [PostController::class, 'store'])->name('posts.store');





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
