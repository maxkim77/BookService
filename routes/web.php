<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CompanyLibraryController;
use App\Http\Controllers\MyLibraryController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\Auth\OauthController;

Auth::routes();
// 로그인 구글 
Route::prefix('/login/google')->group(function () {
    Route::get('', [OauthController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('/callback', [OauthController::class, 'handleGoogleCallback'])->name('login.google.callback');
    
});
// 회사 서재
Route::prefix('')->middleware(['auth.user'])->group(function () {
    Route::get('/', [CompanyLibraryController::class, 'index'])->name('company.library')->middleware('auth');

});

// 마이 서재
Route::prefix('mylibrary')->middleware(['auth.user'])->group(function () {
    Route::get('/', [MyLibraryController::class, 'index'])->name('my.library');
});

// 리뷰 (글쓰기)
Route::prefix('review')->group(function () {
    Route::get('/{review_id}', [ReviewController::class, 'show'])->name('review.show')->whereNumber('review_id');
    Route::post('/', [ReviewController::class, 'store'])->name('review.store');
    Route::get('/{review_id}/edit', [ReviewController::class, 'edit'])->name('review.edit')->whereNumber('review_id');
    Route::put('/{review_id}', [ReviewController::class, 'update'])->name('review.update')->whereNumber('review_id');
    Route::delete('/{review_id}', [ReviewController::class, 'destroy'])->name('review.destroy')->whereNumber('review_id');
});

// 특정 책에 대한 리뷰 글 리스트
Route::prefix('books')->group(function () {
    Route::get('/{id}', [BookController::class, 'show'])->name('books.show');
});


// 좋아요 페이지
Route::prefix('/likes')->group(function () {
    Route::post('', [LikeController::class, 'store'])->name('likes.store');
    Route::delete('/{id}', [LikeController::class, 'destroy'])->name('likes.destroy');
});

