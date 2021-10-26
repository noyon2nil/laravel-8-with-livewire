<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Livewire\Admin\Category\Category;
use App\Http\Livewire\Admin\SubCategory\ListSubCategory;
use App\Http\Livewire\Admin\Users\ListUsers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('dashboard', DashboardController::class)->name('dashboard');
Route::get('users', ListUsers::class)->name('users');
Route::get('categories', Category::class)->name('categories');
Route::get('sub-category', ListSubCategory::class)->name('sub.category');
