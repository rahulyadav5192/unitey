<?php

use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\InquiryController;
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

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store'])->name('login.store');

    Route::middleware('auth')->group(function () {
        Route::get('/', [ContentController::class, 'home'])->name('home');
        Route::get('/messages', [ContentController::class, 'messages'])->name('messages');
        Route::get('/pages/{page}', [ContentController::class, 'edit'])->name('edit');
        Route::put('/pages/{page}', [ContentController::class, 'update'])->name('update');
        Route::post('/pages/{page}/sections/{section}/restore', [ContentController::class, 'restore'])->name('restore');
        Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');
    });
});
