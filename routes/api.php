<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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

Route::get('/posts', [PostController::class, 'api_list_post']);

Route::middleware('auth:sanctum')->group(function(){

    Route::post('/posts/create', [PostController::class, 'api_create_post']);
    Route::post('/posts/comment/{post}', [CommentController::class, 'api_comment']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});
