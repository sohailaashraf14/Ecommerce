<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Default home route
Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Auth::routes();

// User home route
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Product resource routes
    Route::resource('products', ProductController::class)->names('products');
});
