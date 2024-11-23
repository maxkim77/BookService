<?php
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BookController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/books', [BookController::class, 'index'])->name('api.books.index');
Route::get('/books/{id}', [BookController::class, 'show'])->name('api.books.show');
