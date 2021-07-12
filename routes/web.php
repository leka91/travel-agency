<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'home'])->name('pages.home');
Route::get('/services', [PageController::class, 'services'])->name('pages.services');
Route::get('/events', [PageController::class, 'events'])->name('pages.events');
Route::get('/about', [PageController::class, 'about'])->name('pages.about');
Route::get('/contact', [PageController::class, 'contact'])->name('pages.contact');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/tours', [TourController::class, 'tours'])->name('admin.tours');
    Route::get('/tours/add-new-tour', [TourController::class, 'newTourForm'])->name('admin.newTourForm');
    Route::get('/categories', [CategoryController::class, 'getAllCategories'])->name('admin.categories');
    Route::get('/categories/add-new-category', [CategoryController::class, 'newCategoryForm'])->name('admin.newCategoryForm');
    Route::post('/categories', [CategoryController::class, 'addNewCategory'])->name('admin.addNewCategory');
    Route::get('/categories/edit-category/{category}', [CategoryController::class, 'editCategoryForm'])->name('admin.editCategoryForm');
    Route::put('/categories/{category}', [CategoryController::class, 'editCategory'])->name('admin.editCategory');

    Route::post('/upload', [UploadController::class, 'store']);
    Route::delete('/upload-remove', [UploadController::class, 'destroy']);
});