<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\MultiImageController;
use App\Models\User;
use App\Models\multipic;
use Illuminate\Support\Facades\DB;

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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $about = DB::table('home_abouts')->first();
    $images = Multipic::all();
    return view('home', compact('brands', 'about', 'images'));
});

Route::get('/home', function () {
    echo " This is home page ";
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', [ContactController::class, 'index']);

// Category Controller
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');

Route::get('/category/edit/{id}', [CategoryController::class, 'edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'update']);
Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'restore']);
Route::get('/pdelete/category/{id}', [CategoryController::class, 'pdelete']);


// For Brand

Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'StoreBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'Update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);

//Multi Image 

Route::get('/multi/image', [MultiImageController::class, 'multipic'])->name('multi.image');
Route::post('/image/add', [MultiImageController::class, 'StoreImg'])->name('store.image');




//Home about All routes
Route::get('/home/about', [AboutController::class, 'HomeAbout'])->name('home.about');
Route::get('/add/about', [AboutController::class, 'AddAbout'])->name('add.about');
Route::post('/store/about', [AboutController::class, 'StoreAbout'])->name('store.about');
Route::get('/about/edit/{id}', [AboutController::class, 'EditAbout']);
Route::post('/update/homeabout/{id}', [AboutController::class, 'UpdateAbout']);
Route::get('/about/delete/{id}', [AboutController::class, 'DeleteAbout']);



//Portfolio 
Route::get('/portfolio', [PortfolioController::class, 'Portfolio'])->name('portfolio');


//Home contact routes
Route::get('/contact', [ContactController::class, 'Contact'])->name('contact');


#contact Form routes#
Route::post('/contact/form', [ContactController::class, 'ContactForm'])->name('contact.form');
Route::get('/admin/message', [ContactController::class, 'AdminMessage'])->name('admin.message');
Route::get('admin/message/delete/{id}', [ContactController::class, 'DeleteMessage']);





Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
    // $users = DB::table('users')->get();

    return view('admin.pages.index');
})->name('dashboard');

Route::get('/user/logout', [BrandController::class, 'logout'])->name('user.logout');

