<?php
use Illuminate\Support\Facades\Route;
use Modules\InventoryManagement\Http\Controllers\Backend\CategoryController;



Route::prefix('cd-admin')->name('cd-admin.')->group(function(){
   Route::get('/view-categories', [CategoryController::class, 'index'])->name('view_categories');
   Route::get('/create-category', [CategoryController::class, 'create'])->name('create_category');
   Route::post('/save-category', [CategoryController::class, 'store'])->name('store_category');
   Route::get('/edit-category', [CategoryController::class, 'edit'])->name('edit_category');
   Route::post('/update-category', [CategoryController::class, 'update'])->name('update_category');
   Route::get('/delete-category/{slug}', [CategoryController::class, 'destroy'])->name('delete_category');
   Route::post('/deleteMultipleImages', [CategoryController::class, 'deleteMultipleImages'])->name('category.image.delete');

});
Route::get('cd-admin/changestatus', [CategoryController::class, 'changestatus'])->name('changestatus');

