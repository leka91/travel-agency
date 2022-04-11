<?php

use App\Http\Controllers\Admin\BelgradeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\RequirementController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

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

// home
Route::get('/', [PageController::class, 'home'])->name('pages.home');

// tours
Route::get('/tours', [PageController::class, 'tours'])->name('pages.tours');
Route::get('/tour/{tourSlug}', [PageController::class, 'showTour'])->name('pages.tour');
Route::get('/tours/category/{categorySlug}', [PageController::class, 'categoryRelatedTours'])->name('pages.categoryRelatedTours');
Route::get('/tours/tag/{tagSlug}', [PageController::class, 'tagRelatedTours'])->name('pages.tagRelatedTours');
Route::get('/tours/popular', [PageController::class, 'popularTours'])->name('pages.popularTours');

// about
Route::get('/about', [PageController::class, 'about'])->name('pages.about');

// contact
Route::get('/contact', [PageController::class, 'contact'])->name('pages.contact');
Route::post('/contact', [PageController::class, 'sendContactMessage'])
    ->name('pages.sendContactMessage')
    ->middleware(ProtectAgainstSpam::class);

// belgrade
Route::get('/belgrade', [PageController::class, 'belgrade'])->name('pages.belgrade');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // tours
    Route::get('/tours', [TourController::class, 'getAlltours'])->name('admin.getAlltours');
    Route::get('/tours/add-new-tour', [TourController::class, 'newTourForm'])->name('admin.newTourForm');
    Route::post('/tours', [TourController::class, 'addNewTour'])->name('admin.addNewTour');
    Route::get('/tours/edit-tour/{tourId}', [TourController::class, 'editTourForm'])->name('admin.editTourForm');
    Route::put('/tours/{tour}', [TourController::class, 'editTour'])->name('admin.editTour');
    Route::delete('/tours/remove-tour', [TourController::class, 'removeTour'])->name('admin.removeTour');
    Route::get('/tours/removed-tours', [TourController::class, 'getAllRemovedTours'])->name('admin.getAllRemovedTours');
    Route::put('/tours/restore/{tour}', [TourController::class, 'restoreTour'])->name('admin.restoreTour');
    Route::delete('/tours/delete-tour', [TourController::class, 'deleteTour'])->name('admin.deleteTour');

    // belgrade
    Route::get('/belgrade', [BelgradeController::class, 'getBelgradeInfo'])->name('admin.getBelgradeInfo');
    Route::post('/belgrade', [BelgradeController::class, 'addBelgradeInfo'])->name('admin.addBelgradeInfo');
    Route::put('/belgrade/{belgrade}', [BelgradeController::class, 'editBelgradeInfo'])->name('admin.editBelgradeInfo');

    // galleries
    Route::post('/galleries/remove-gallery-image', [GalleryController::class, 'removeGalleryImage']);

    // categories
    Route::get('/categories', [CategoryController::class, 'getAllCategories'])->name('admin.categories');
    Route::get('/categories/add-new-category', [CategoryController::class, 'newCategoryForm'])->name('admin.newCategoryForm');
    Route::post('/categories', [CategoryController::class, 'addNewCategory'])->name('admin.addNewCategory');
    Route::get('/categories/edit-category/{category}', [CategoryController::class, 'editCategoryForm'])->name('admin.editCategoryForm');
    Route::put('/categories/{category}', [CategoryController::class, 'editCategory'])->name('admin.editCategory');

    // requirements
    Route::get('/requirements', [RequirementController::class, 'getAllRequirements'])->name('admin.requirements');
    Route::get('/requirements/add-new-requirement', [RequirementController::class, 'newRequirementForm'])->name('admin.newRequirementForm');
    Route::get('/requirements-search', [RequirementController::class, 'searchRequirement']);
    Route::post('/requirements', [RequirementController::class, 'addNewRequirement'])->name('admin.addNewRequirement');
    Route::get('/requirements/edit-requirement/{requirement}', [RequirementController::class, 'editRequirementForm'])->name('admin.editRequirementForm');
    Route::put('/requirements/{requirement}', [RequirementController::class, 'editRequirement'])->name('admin.editRequirement');

    // tags
    Route::get('/tags', [TagController::class, 'getAllTags'])->name('admin.tags');
    Route::get('/tags-search', [TagController::class, 'searchTag']);
    Route::get('/tags/add-new-tag', [TagController::class, 'newTagForm'])->name('admin.newTagForm');
    Route::post('/tags', [TagController::class, 'addNewTag'])->name('admin.addNewTag');
    Route::get('/tags/edit-tag/{tag}', [TagController::class, 'editTagForm'])->name('admin.editTagForm');
    Route::put('/tags/{tag}', [TagController::class, 'editTag'])->name('admin.editTag');

    // temoporary upload
    Route::post('/upload', [UploadController::class, 'store']);
    Route::post('/upload-heroimage', [UploadController::class, 'storeHeroImage']);
    Route::post('/upload-belgradeimage', [UploadController::class, 'storeBelgradeImage']);
    Route::delete('/upload-remove', [UploadController::class, 'destroy']);
});