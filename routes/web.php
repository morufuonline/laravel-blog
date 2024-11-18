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

Route::controller(PostController::class)->group(function(){
Route::get('/', 'home');
Route::post('/search', 'search');
Route::get('/details/{post}', 'details');
});

Route::get('/dashboard', function () {
    return view('dashboard', ["title" => "Dashboard"]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::controller(PostController::class)->group(function(){
    Route::get('/posts', 'index')->name('posts');
    Route::get('/posts/view/{poster}', 'show');
    Route::post('/posts/search', 'posts_search');
    Route::get('/posts/create', 'create');
    Route::post('/posts/store', 'store');
    Route::get('/posts/edit/{poster}', 'edit');
    Route::put('/posts/update/{poster}', 'update');
    Route::delete('/posts/delete/{poster}', 'destroy');
    });

    Route::post('/comment/{post}', [CommentController::class, 'store']);

    Route::controller(ProfileController::class)->group(function(){
    Route::get('/profile', 'edit')->name('profile.edit');
    Route::patch('/profile', 'update')->name('profile.update');
    Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

});

require __DIR__.'/auth.php';
