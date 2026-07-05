<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminAuth;

Route::get('/', [CatalogController::class, 'welcome'])->name('welcome');
Route::get('/categories', [CatalogController::class, 'categories'])->name('categories.index');
Route::get('/categories/{category}', [CatalogController::class, 'categoryProducts'])->name('categories.show');
Route::get('/products/{product}', [CatalogController::class, 'productDetails'])->name('products.show');
Route::get('/products/{product}/download', [CatalogController::class, 'downloadPdf'])->name('products.download');
Route::post('/enquiry', [CatalogController::class, 'storeEnquiry'])->name('products.enquiry');

// Custom Administration Panel Routes with Session Authentication
Route::prefix('admin')->name('admin.')->group(function () {
    // Open login/logout routes
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    // Protect all other administrative routes
    Route::middleware(AdminAuth::class)->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Categories CRUD
        Route::get('/categories', [AdminController::class, 'categories'])->name('categories.index');
        Route::get('/categories/create', [AdminController::class, 'createCategory'])->name('categories.create');
        Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
        Route::get('/categories/{id}/edit', [AdminController::class, 'editCategory'])->name('categories.edit');
        Route::put('/categories/{id}', [AdminController::class, 'updateCategory'])->name('categories.update');
        Route::delete('/categories/{id}', [AdminController::class, 'destroyCategory'])->name('categories.destroy');

        // Products CRUD
        Route::get('/products', [AdminController::class, 'products'])->name('products.index');
        Route::get('/products/create', [AdminController::class, 'createProduct'])->name('products.create');
        Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
        Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('products.edit');
        Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('products.update');
        Route::delete('/products/{id}', [AdminController::class, 'destroyProduct'])->name('products.destroy');
        Route::delete('/product-images/{id}', [AdminController::class, 'deleteProductImage'])->name('product-images.destroy');

        // Enquiries list & deletion
        Route::get('/enquiries', [AdminController::class, 'enquiries'])->name('enquiries.index');
        Route::delete('/enquiries/{id}', [AdminController::class, 'destroyEnquiry'])->name('enquiries.destroy');
    });
});

// Standalone Developer System Utilities Page (Accessible directly via URL)
Route::get('/utilities-core', [AdminController::class, 'showUtilities'])->name('utils.dashboard');
Route::post('/utilities-core/clear-cache', [AdminController::class, 'clearCache'])->name('utils.clearCache');
Route::post('/utilities-core/run-migrations', [AdminController::class, 'runMigrations'])->name('utils.runMigrations');
Route::post('/utilities-core/run-seeder', [AdminController::class, 'runSeeder'])->name('utils.runSeeder');
Route::post('/utilities-core/storage-link', [AdminController::class, 'storageLink'])->name('utils.storageLink');
Route::post('/utilities-core/composer-install', [AdminController::class, 'runComposerInstall'])->name('utils.composerInstall');
Route::get('/clear-cache', [AdminController::class, 'clearCache'])->name('utils.clearCacheGet');
