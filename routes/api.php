<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

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

Route::prefix("/news")->name("news.")->group(function() {
    Route::Get("/", [NewsController::class, "index"])->name("index");
    Route::Post("/", [NewsController::class, "store"])->name("store");
    Route::Get("/{news}", [NewsController::class, "show"])->name("show");

    Route::Post("/add-comment", [CommentController::class, "store"])->name("add_comment");

    Route::Post("/{news}/like", [LikeController::class, "news"])->name("like");
});

Route::prefix("/comments")->name("comments.")->group(function() {
    Route::Post("/{comment}/like", [LikeController::class, "comment"])->name("like");
});
