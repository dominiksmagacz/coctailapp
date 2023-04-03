<?php

// use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FallbackController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PermissionController;


use App\Http\Controllers\GPT3Controller;


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

    return view('welcome');    //strona główna przed logowaniem
});

Route::middleware(['auth', 'role:admin'])->name('admins.')->prefix('admins')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->middleware(['auth', 'role:admin'])->name('index');
    Route::post('/store', [AdminController::class, 'store'])->middleware(['auth', 'role:admin'])->name('store');
    Route::get('/{id}/show', [AdminController::class, 'show'])->middleware(['auth', 'role:admin'])->name('show');
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->middleware(['auth', 'role:admin'])->name('edit');
    Route::get('/create', [AdminController::class, 'create'])->middleware(['auth', 'role:admin'])->name('create');
    Route::get('/search', [AdminController::class, 'search'])->middleware(['auth', 'role:admin'])->name('search');
    Route::delete('/{id}', [AdminController::class, 'destroy'])->middleware(['auth', 'role:admin'])->name('destroy');
    Route::put('/{id}', [AdminController::class, 'update'])->middleware(['auth', 'role:admin'])->name('update');
});

Route::middleware(['auth', 'role:admin'])->name('permissions.')->prefix('permissions')->group(function () {
    Route::get('/', [PermissionController::class, 'index'])->middleware(['auth', 'role:admin'])->name('index');
    Route::post('/store', [PermissionController::class, 'store'])->middleware(['auth', 'role:admin'])->name('store');
    Route::get('/{id}/show', [PermissionController::class, 'show'])->middleware(['auth', 'role:admin'])->name('show');
    Route::get('/edit/{id}', [PermissionController::class, 'edit'])->middleware(['auth', 'role:admin'])->name('edit');
    Route::get('/create', [PermissionController::class, 'create'])->middleware(['auth', 'role:admin'])->name('create');
    Route::get('/search', [PermissionController::class, 'search'])->middleware(['auth', 'role:admin'])->name('search');
    Route::delete('/{id}', [PermissionController::class, 'destroy'])->middleware(['auth', 'role:admin'])->name('destroy');
    Route::put('/{id}', [PermissionController::class, 'update'])->middleware(['auth', 'role:admin'])->name('update');
});

Route::middleware(['auth', 'role:admin'])->name('roles.')->prefix('roles')->group(function () {
    Route::get('/', [RoleController::class, 'index'])->middleware(['auth', 'role:admin'])->name('index');
    Route::post('/store', [RoleController::class, 'store'])->middleware(['auth', 'role:admin'])->name('store');
    Route::get('/{id}/show', [RoleController::class, 'show'])->middleware(['auth', 'role:admin'])->name('show');
    Route::get('/edit/{id}', [RoleController::class, 'edit'])->middleware(['auth', 'role:admin'])->name('edit');
    Route::get('/create', [RoleController::class, 'create'])->middleware(['auth', 'role:admin'])->name('create');
    Route::get('/search', [RoleController::class, 'search'])->middleware(['auth', 'role:admin'])->name('search');
    Route::delete('/{id}', [RoleController::class, 'destroy'])->middleware(['auth', 'role:admin'])->name('destroy');
    Route::put('/{id}', [RoleController::class, 'update'])->middleware(['auth', 'role:admin'])->name('update');
    Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('permissions');
    Route::post('/roles/{role}/permissions_remove', [RoleController::class, 'removePermission'])->name('permissions.remove');
    Route::post('/roles/{user}', [RoleController::class, 'giveRole'])->name('user');
    Route::post('/roles/{user}/removeRole', [RoleController::class, 'removeRole'])->name('remove');

});

Route::prefix('/posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->middleware(['auth'])->name('posts.index');
    Route::post('/store', [PostController::class, 'store'])->middleware(['auth', 'role:moderator'])->name('posts.store');
    Route::get('/{id}/show', [PostController::class, 'show'])->middleware(['auth', 'role:reader'])->name('posts.show');
    Route::get('/edit/{id}', [PostController::class, 'edit'])->middleware(['auth', 'role:moderator'])->name('posts.edit');
    Route::get('/create', [PostController::class, 'create'])->middleware(['auth', 'role:moderator'])->name('posts.create');
    Route::get('/search', [PostController::class, 'search'])->middleware(['auth'])->name('posts.search');
    Route::delete('/{id}', [PostController::class, 'destroy'])->middleware(['auth', 'role:moderator'])->name('posts.destroy');
    Route::put('/{id}', [PostController::class, 'update'])->middleware(['auth', 'role:moderator'])->name('posts.update');
});

Route::prefix('/recipes')->group(function () {
    Route::get('/', [RecipeController::class, 'index'])->middleware(['auth'])->name('recipes.index');
    Route::post('/store', [RecipeController::class, 'store'])->middleware(['auth', 'role:moderator'])->name('recipes.store');
    Route::get('/{id}/show', [RecipeController::class, 'show'])->middleware(['auth', 'role:reader'])->name('recipes.show');
    Route::get('/edit/{id}', [RecipeController::class, 'edit'])->middleware(['auth', 'role:moderator'])->name('recipes.edit');
    Route::get('/search', [RecipeController::class, 'search'])->middleware(['auth'])->name('recipes.search');
    Route::get('/create', [RecipeController::class, 'create'])->middleware(['auth', 'role:moderator'])->name('recipes.create');
    Route::delete('/{id}', [RecipeController::class, 'destroy'])->middleware(['auth', 'role:moderator'])->name('recipes.destroy');
    Route::put('/{id}', [RecipeController::class, 'update'])->middleware(['auth', 'role:moderator'])->name('recipes.update');
});

// Route::get('/shops', [ShopController::class, 'index'])->name('shops.index');
//Route::get('/home',HomeController::class)->name('home');
Route::get('/users/{id}/show', [UserController::class, 'show'])->name('users.show');

Route::fallback(FallbackController::class, '__invoke');

Route::prefix('/shops')->group(function () {
    Route::get('/', [ProductController::class, 'productList'])->name('shops.productList');
    Route::get('cart', [ProductController::class, 'cartList'])->name('cart.list');
    Route::post('cart', [ProductController::class, 'addToCart'])->name('cart.store');
});


Route::get('/dashboard', function () {
    return view('dashboard', ['result' => null]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//AND ADD THIS LINE !
Route::get("/gpt3", [GPT3Controller::class, "index"])->name("gpt3Route")->name('gpt3');


require __DIR__ . '/auth.php';
