<?php

use App\Http\Controllers\CommentController;
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
});
