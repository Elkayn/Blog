<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\StatisticController;
use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\IsAdminMiddleware;

Route::middleware(['auth', IsAdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');

    Route::post('/posts/cache', [PostController::class, 'storeCache'])->name('admin.post.cache');
    Route::get('/posts', [PostController::class, 'index'])->name('admin.posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('admin.posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
    Route::patch('/posts/{post}', [PostController::class, 'update'])->name('admin.posts.update');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('admin.posts.show');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('admin.posts.destroy');

    Route::get('/tags', [TagController::class, 'index'])->name('admin.tags.index');

    Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles.index');

    Route::get('/profiles', [ProfileController::class, 'index'])->name('admin.profiles.index');

    Route::get('/comments', [CommentController::class, 'index'])->name('admin.comments.index');

    Route::post('/categories/cache', [CategoryController::class, 'storeCache'])->name('admin.category.cache');
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::patch('/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('admin.categories.show');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    Route::get('/statistics', [StatisticController::class, 'index'])->name('admin.statistic.index');
});
