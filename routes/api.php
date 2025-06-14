<?php

use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// I use prefix and group api------------------\
Route::prefix("/library")->group(function() {
    Route::get("/books", [BookController::class, "index"])->name("allBooks");
    Route::get("/books/{id}", [BookController::class, "showBook"]);
    Route::post("/books", [BookController::class, "createBook"]);
    Route::put("/books/{id}", [BookController::class, "editBook"]);
    Route::delete("/books/{id}", [BookController::class, "deleteBook"]);
});
// ---------------------------------------------------

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
