<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'admin'])->group(function(){

    Route::controller(AdminPostController::class)->group(function(){
        Route::get('/posts', 'admin_index')->middleware("role:browse_posts")->name("admin.posts");
        Route::get('/posts/view/{post}', 'admin_show')->middleware("role:read_posts");
        Route::post('/posts/search', 'admin_posts_search')->middleware("role:browse_posts");
        Route::get('/posts/create', 'admin_create')->middleware("role:create_posts");
        Route::post('/posts/store', 'admin_store')->middleware("role:create_posts");
        Route::get('/posts/edit/{post}', 'admin_edit')->middleware("role:edit_posts");
        Route::put('/posts/update/{post}', 'admin_update')->middleware("role:edit_posts");
        Route::delete('/posts/delete/{post}', 'admin_destroy')->middleware("role:delete_posts");
    });

    //Route::post('/comment/{post}', [CommentController::class, 'store']);

});
