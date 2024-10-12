<?php

use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/posts/{post}/comments', [PostController::class, 'storeComment'])->name('posts.store.comment');
    Route::get('/posts/{post}/comments', [PostController::class, 'showComments'])->name('posts.show.comments');
    Route::post('/posts/{post}/likes', [ProfileController::class, 'toggleLike'])->name('posts.likes.toggle');

    Route::post('/comments/{comment}/likes', [PostController::class, 'toggleLikeComment'])->name('post.comments.likes.toggle');
    Route::post('/comments/{comment}', [PostController::class, 'storeAnswerComment'])->name('store.answer.comments');
    Route::get('/comments/{comment}', [PostController::class, 'showAnswers'])->name('comments.show.answers');
});

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
