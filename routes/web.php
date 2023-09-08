<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\User;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
  
  require __DIR__ . '/auth.php';
  


/************** users routes*************/
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/user/create', [UserController::class, 'create'])->name('users.create');
Route::get('/user/show/{user}', [UserController::class, 'show'])->name('users.show');
Route::post('/user/store', [UserController::class, 'store'])->name('users.store');
Route::get('/user/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
Route::post('/user/update/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/user/delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');

/************** posts routes*************/

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');
Route::get('/post/show/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/post/store', [PostController::class, 'store'])->name('posts.store');
Route::get('/post/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/post/update/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/post/delete/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

//Route::resource('/posts', PostController::class);





















