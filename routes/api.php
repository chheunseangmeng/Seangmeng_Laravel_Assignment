<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// I use prefix and group api ( library )------------------\
Route::prefix("/library")->group(function () {
    Route::get("/books", [BookController::class, "index"])->name("allBooks");
    Route::get("/books/{id}", [BookController::class, "showBook"]);
    Route::post("/books", [BookController::class, "createBook"]);
    Route::put("/books/{id}", [BookController::class, "editBook"]);
    Route::delete("/books/{id}", [BookController::class, "deleteBook"]);
});
// ---------------------------------------------------

// I use prefix and group api ( author )------------------\
Route::prefix("/author")->group(function () {
    Route::get("/authors", [AuthorController::class, "index"])->name("allAuthor");
    Route::get("/authors/{id}", [AuthorController::class, "showAuthor"]);
    Route::post("/authors", [AuthorController::class, "createAuthor"]);
    Route::put("/authors/{id}", [AuthorController::class, "editAuthor"]);
    Route::delete("/authors/{id}", [AuthorController::class, "deleteAuthor"]);
    Route::get('/{id}/books', [AuthorController::class, 'booksByAuthor']);
    Route::get('/{id}/name', [AuthorController::class, 'getAuthorName']);
});
// ---------------------------------------------------

// I use prefix and group api ( user )------------------\
Route::prefix("/user")->group(function () {
    Route::get("/users", [UserController::class, "index"])->name("allUsers");
    Route::get("/users/{id}", [UserController::class, "showUser"]);
    Route::post("/users", [UserController::class, "createUser"]);
    Route::put("/users/{id}", [UserController::class, "editUser"]);
    Route::delete("/users/{id}", [UserController::class, "deleteUser"]);
});
// ---------------------------------------------------

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
