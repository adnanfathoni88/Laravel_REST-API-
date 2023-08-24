<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CommentController;
use Symfony\Component\CssSelector\Parser\Handler\CommentHandler;

Route::get('/posts', [PostController::class, 'index'])->middleware('auth:sanctum')->name('posts');
Route::get('/posts/{id}', [PostController::class, 'show'])->middleware('auth:sanctum')->name('show');

Route::post('/login', [AuthenticationController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/user', [AuthenticationController::class, 'user']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::patch('/update/{id}', [PostController::class, 'update'])->middleware('author');
    Route::delete('/delete/{id}', [PostController::class, 'destroy'])->middleware('author');
    Route::post('/comments', [CommentController::class, 'store']);
    Route::patch('/comments/{id}', [CommentController::class, 'update'])->middleware('commentator');
    Route::delete('/delete/{id}', [CommentController::class, 'destroy'])->middleware('commentator');
});
