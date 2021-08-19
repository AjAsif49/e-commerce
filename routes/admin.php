<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;



Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    //Admin Contact page
    Route::get('contact', [ContactController::class, 'AdminContact'])->name('admin.contact');
    Route::get('add/contact', [ContactController::class, 'AdminAddContact'])->name('add.contact');
    Route::post('store/contact', [ContactController::class, 'AdminStoreContact'])->name('store.contact');
    Route::get('contact/edit/{id}', [ContactController::class, 'EditContact']);
    Route::post('update/contact/{id}', [ContactController::class, 'UpdateContact']);
    Route::get('contact/delete/{id}', [ContactController::class, 'DeleteContact']);

    //Admin All route
    Route::get('home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
    Route::get('add/slider', [HomeController::class, 'AddSlider'])->name('add.slider');
    Route::post('store/slider', [HomeController::class, 'StoreSlider'])->name('store.slider');
    Route::get('slider/edit/{id}', [HomeController::class, 'Edit']);
    Route::post('slider/update/{id}', [HomeController::class, 'Update']);
    Route::get('slider/delete/{id}', [HomeController::class, 'Delete']);

    
});

// require __DIR__ . '/auth.php';