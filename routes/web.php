<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
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


Route::get('/', [PostController::class, 'home']);
Route::post('/search', [PostController::class, 'search']);
Route::get('/details/{post}', [PostController::class, 'details'])->where('post', '[0-9]+');

Route::get('/dashboard', function () {
    return view('dashboard', ["title" => "Dashboard"]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/view/{post}', [PostController::class, 'show'])->where('post', '[0-9]+');
    Route::post('/posts/search', [PostController::class, 'posts_search']);
    Route::get('/posts/create', [PostController::class, 'create']);
    Route::post('/posts/store', [PostController::class, 'store']);
    Route::get('/posts/edit/{post}', [PostController::class, 'edit'])->where('post', '[0-9]+');
    Route::put('/posts/update/{post}', [PostController::class, 'update'])->where('post', '[0-9]+');
    Route::delete('/posts/delete/{post}', [PostController::class, 'destroy'])->where('post', '[0-9]+');

    Route::post('/comment/{post}', [CommentController::class, 'store'])->where('post', '[0-9]+');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
