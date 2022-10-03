<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\TipController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\LinkCategoryController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\HomeController;
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

// homepage
Route::get('/', [WebsiteController::class, 'index'])->name('home');
Route::get('/casino-best-bonus', [WebsiteController::class, 'casino_bonus'])->name('bonus');
Route::get('/casino-tips', [WebsiteController::class, 'casino_tips'])->name('tips');
Route::get('sign-up-bonus/{id}', [WebsiteController::class, 'signUpBonus']);
Route::post('sign-up-bonus/', [WebsiteController::class, 'claimed_offer'])->name('claimed.offer');
Route::get('/help', [WebsiteController::class, 'help'])->name('help');
Route::get('/contact', [WebsiteController::class, 'contact'])->name('contact');
Route::get('/signin', [WebsiteController::class, 'user_login'])->name('user_login');

// admin login
Route::get('/admin', [LoginController::class, 'adminLogin'])->name('admin.login');

// ADMIN ACCOUNT ROUTES
Route::group(['prefix' => 'admin', 'middleware' => ['is_admin']], function(){
    //banners
     Route::get('/banners', [BannerController::class, 'index'])->name('admin.banner');
    // admin profile
    Route::get('/profile', [HomeController::class, 'profile'])->name('admin.profile');
    //admin profile update
    Route::put('/profile', [HomeController::class, 'adminProfileUpdate'])->name('adminProfile.update');
    // admin home
    Route::get('/home', [HomeController::class, 'index'])->name('admin.home');

    // banners
    Route::post('/banner/store', [BannerController::class, 'store'])->name('admin.banner.store');
    Route::delete('/banner/destroy', [BannerController::class, 'destroy'])->name('admin.banner.destroy');

    // offers
    Route::get('/offers', [OfferController::class, 'index'])->name('admin.offer');
    Route::post('/offer/store', [OfferController::class, 'store'])->name('admin.offer.store');
    Route::delete('/offer/destroy', [OfferController::class, 'destroy'])->name('admin.offer.destroy');

    // help image
    Route::get('/help', [HelpController::class, 'index'])->name('admin.help');
    Route::post('/help/store', [HelpController::class, 'store'])->name('admin.help.store');
    Route::delete('/help/destroy', [HelpController::class, 'destroy'])->name('admin.help.destroy');

    // tip image
    Route::get('/tips', [TipController::class, 'index'])->name('admin.tip');
    Route::post('/tip/store', [TipController::class, 'store'])->name('admin.tip.store');
    Route::delete('/tip/destroy', [TipController::class, 'destroy'])->name('admin.tip.destroy');

    // tip link
    Route::get('/links', [LinkController::class, 'index'])->name('admin.link');
    Route::post('/link/store', [LinkController::class, 'store'])->name('admin.link.store');
    Route::delete('/link/destroy', [LinkController::class, 'destroy'])->name('admin.link.destroy');

    // category
    Route::get('/links/categories', [LinkCategoryController::class, 'index'])->name('admin.link.category');
    Route::post('/category/store', [LinkCategoryController::class, 'store'])->name('admin.category.store');
    Route::delete('/category/destroy', [LinkCategoryController::class, 'destroy'])->name('admin.category.destroy');

    // users
    Route::get('/registered-users', [HomeController::class, 'registeredUser'])->name('admin.users');

});

// USER REGISTERED
Route::group(['prefix' => 'user', 'middleware' => ['is_user']], function(){
Route::get('/home', [HomeController::class, 'user'])->name('user.home');
// user home
Route::get('/profile', [HomeController::class, 'userProfile'])->name('user.profile');
//user profile update
 Route::put('/profile', [HomeController::class, 'userProfileUpdate'])->name('userProfile.update');
Route::post('/profile', [HomeController::class, 'storeClaimedOffer'])->name('user.claimed');

});


// redirect user if not logged in 

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
