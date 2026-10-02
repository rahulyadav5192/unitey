<?php

use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.index')->name('home');
Route::view('/company', 'pages.company')->name('company');
Route::view('/portfolio', 'pages.portfolio')->name('portfolio');
Route::view('/investments', 'pages.investments')->name('investments');
Route::view('/news', 'pages.news')->name('news');
Route::view('/blog-detail', 'pages.blog-detail')->name('blog-detail');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/privacy-policy', 'pages.privacy-policy')->name('privacy-policy');
Route::view('/terms-conditions', 'pages.terms-conditions')->name('terms-conditions');

Route::redirect('/index.html', '/');
Route::get('/company.html', fn () => redirect()->route('company'));
Route::get('/portfolio.html', fn () => redirect()->route('portfolio'));
Route::get('/investments.html', fn () => redirect()->route('investments'));
Route::get('/news.html', fn () => redirect()->route('news'));
Route::get('/blog-detail.html', fn () => redirect()->route('blog-detail'));
Route::get('/contact.html', fn () => redirect()->route('contact'));
Route::get('/privacy-policy.html', fn () => redirect()->route('privacy-policy'));
Route::get('/terms-conditions.html', fn () => redirect()->route('terms-conditions'));

Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');
Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribers.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store'])->name('login.store');

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');

        Route::middleware('admin.access:overview')->group(function () {
            Route::get('/', [ContentController::class, 'home'])->name('home');
        });

        Route::middleware('admin.access:messages')->group(function () {
            Route::get('/messages', [ContentController::class, 'messages'])->name('messages');
            Route::delete('/messages/{inquiry}', [ContentController::class, 'destroyMessage'])->name('messages.destroy');
            Route::get('/messages/export', [ContentController::class, 'exportMessages'])->name('messages.export');
        });

        Route::middleware('admin.access:subscribers')->group(function () {
            Route::get('/subscribers', [ContentController::class, 'subscribers'])->name('subscribers');
            Route::delete('/subscribers/{subscriber}', [ContentController::class, 'destroySubscriber'])->name('subscribers.destroy');
            Route::get('/subscribers/export', [ContentController::class, 'exportSubscribers'])->name('subscribers.export');
        });

        Route::middleware('admin.access:users')->group(function () {
            Route::get('/users', [UserController::class, 'index'])->name('users.index');
            Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/users', [UserController::class, 'store'])->name('users.store');
            Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
            Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        });

        Route::middleware('admin.access:roles')->group(function () {
            Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
            Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
            Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
            Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
            Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
            Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
        });

        Route::middleware('admin.access:page')->group(function () {
            Route::get('/pages/{page}', [ContentController::class, 'edit'])->name('edit');
            Route::put('/pages/{page}', [ContentController::class, 'update'])->name('update');
            Route::post('/pages/{page}/sections/{section}/restore', [ContentController::class, 'restore'])->name('restore');
        });
    });
});
