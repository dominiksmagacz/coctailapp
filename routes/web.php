<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ShopController;
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

Route::prefix('/admins')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->middleware(['auth', 'role:admin'])->name('admins.index');
    Route::post('/store', [AdminController::class, 'store'])->middleware(['auth', 'role:admin'])->name('admins.store');
    Route::get('/{id}/show', [AdminController::class, 'show'])->middleware(['auth', 'role:admin'])->name('admins.show');
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->middleware(['auth', 'role:admin'])->name('admins.edit');
    Route::get('/create', [AdminController::class, 'create'])->middleware(['auth', 'role:admin'])->name('admins.create');
    Route::get('/search', [AdminController::class, 'search'])->middleware(['auth', 'role:admin'])->name('admins.search');
    Route::delete('/{id}', [AdminController::class, 'destroy'])->middleware(['auth', 'role:admin'])->name('admins.destroy');
    Route::put('/{id}', [AdminController::class, 'update'])->middleware(['auth', 'role:admin'])->name('admins.update');
});

Route::prefix('/posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::post('/store', [PostController::class, 'store'])->middleware(['auth', 'role:moderator'])->name('posts.store');
    Route::get('/{id}/show', [PostController::class, 'show'])->middleware(['auth', 'role:reader'])->name('posts.show');
    Route::get('/edit/{id}', [PostController::class, 'edit'])->middleware(['auth', 'role:moderator'])->name('posts.edit');
    Route::get('/create', [PostController::class, 'create'])->middleware(['auth', 'role:moderator'])->name('posts.create');
    Route::get('/search', [PostController::class, 'search'])->name('posts.search');
    Route::delete('/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::put('/{id}', [PostController::class, 'update'])->middleware(['auth', 'role:moderator'])->name('posts.update');
});

Route::prefix('/recipes')->group(function () {
    Route::get('/', [RecipeController::class, 'index'])->name('recipes.index');
    Route::post('/store', [RecipeController::class, 'store'])->middleware(['auth', 'role:moderator'])->name('recipes.store');
    Route::get('/{id}/show', [RecipeController::class, 'show'])->middleware(['auth', 'role:reader'])->name('recipes.show');
    Route::get('/edit/{id}', [RecipeController::class, 'edit'])->middleware(['auth', 'role:moderator'])->name('recipes.edit');
    Route::get('/search', [RecipeController::class, 'search'])->name('recipes.search');
    Route::get('/create', [RecipeController::class, 'create'])->middleware(['auth', 'role:moderator'])->name('recipes.create');
    Route::delete('/{id}', [RecipeController::class, 'destroy'])->name ('recipes.destroy');
    Route::put('/{id}', [RecipeController::class, 'update'])->middleware(['auth', 'role:moderator'])->name('recipes.update');
});

Route::get('/shops', [ShopController::class, 'index'])->name('shops.index');
//Route::get('/home',HomeController::class)->name('home');
Route::get('/users/{id}/show', [UserController::class, 'show'])->name('users.show');






Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__ . '/auth.php';
