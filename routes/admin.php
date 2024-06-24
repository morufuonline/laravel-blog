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

Route::middleware('admin')->group(function(){

    Route::controller(AdminPostController::class)->group(function(){
        Route::get('/admin/posts', 'admin_index')->name("admin.posts");
        Route::get('/admin/posts/view/{post}', 'admin_show');
        Route::post('/admin/posts/search', 'admin_posts_search');
        Route::get('/admin/posts/create', 'admin_create');
        Route::post('/admin/posts/store', 'admin_store');
        Route::get('/admin/posts/edit/{post}', 'admin_edit');
        Route::put('/admin/posts/update/{post}', 'admin_update');
        Route::delete('/admin/posts/delete/{post}', 'admin_destroy');
    });

    //Route::post('/comment/{post}', [CommentController::class, 'store']);

});
