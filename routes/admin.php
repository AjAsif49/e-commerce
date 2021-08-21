<?php
use App\Http\Controllers\ChangePass;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;



Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    //Admin Contact page
    Route::get('contact', [ContactController::class, 'AdminContact'])->name('admin.contact');
    Route::get('add/contact', [ContactController::class, 'AdminAddContact'])->name('add.contact');
    Route::post('store/contact', [ContactController::class, 'AdminStoreContact'])->name('store.contact');
    Route::get('contact/edit/{id}', [ContactController::class, 'EditContact']);
    Route::post('update/contact/{id}', [ContactController::class, 'UpdateContact']);
    Route::get('contact/delete/{id}', [ContactController::class, 'DeleteContact']);

    //Admin All routes
    Route::get('home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
    Route::get('add/slider', [HomeController::class, 'AddSlider'])->name('add.slider');
    Route::post('store/slider', [HomeController::class, 'StoreSlider'])->name('store.slider');
    

    //Home about All routes
    
    

    #password change and user profile route
    Route::get('/user/password', [ChangePass::class, 'ChangePassword'])->name('change.password');
    Route::POST('/password/update', [ChangePass::class, 'UpdatePassword'])->name('password.update');

    //Profile Update
    Route::get('/user/profile', [ChangePass::class, 'UserProfile'])->name('user.profile');
    Route::post('/user/profile/update', [ChangePass::class, 'ProfileUpdate'])->name('update.user.profile');

});

// require __DIR__ . '/auth.php';