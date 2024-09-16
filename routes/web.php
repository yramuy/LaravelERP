<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ImageContoller;
use App\Http\Controllers\SideNavController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('home', [FrontendController::class, 'index'])->name('home');
Route::get('portfolio_details', [FrontendController::class, 'portfolioDetails'])->name('portfolio_details');

// Route::middleware(['checkSessionData'])->group(function () {
//     Route::get('dashboard', [BackendController::class, 'index'])->name('dashboard');
// });


Route::group(['middleware' => 'admin.guest'], function () {
    Route::get('login', [BackendController::class, 'loginPage'])->name('login');
    Route::post('login', [BackendController::class, 'login'])->name('login');
    Route::get('signup', [BackendController::class, 'signupPage'])->name('signup');
    Route::post('signup', [BackendController::class, 'signup'])->name('signup');
});

Route::group(['middleware' => 'admin.auth'], function () {
    Route::get('dashboard', [BackendController::class, 'index'])->name('dashboard');
    Route::get('logout', [BackendController::class, 'logout'])->name('logout');
    Route::get('verification/{id}', [BackendController::class, 'verification']);
    Route::post('verified', [BackendController::class, 'verifiedOtp'])->name('verifiedOtp');
    Route::get('resend-otp', [BackendController::class, 'resendOtp'])->name('resendOtp');
    // SideNav Routes

    // About
    Route::get('about', [SideNavController::class, 'aboutPage'])->name('about');
    Route::post('about', [SideNavController::class, 'saveAbout'])->name('about');
    Route::get('deleteSkill', [SideNavController::class, 'deleteSkill'])->name('deleteSkill');

    // Services
    Route::get('service', [SideNavController::class, 'ServicePage'])->name('service');
    Route::get('services', [SideNavController::class, 'ServiceList'])->name('services');
    Route::post('services', [SideNavController::class, 'saveService'])->name('services');
    Route::get('serviceData', [SideNavController::class, 'serviceData'])->name('serviceData');
    Route::get('delete-service', [SideNavController::class, 'deleteService'])->name('delete-service');

    // Blog
    Route::get('blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('blogs/store', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('blogs/edit/{id}', [BlogController::class, 'create'])->name('blogs.edit');
    Route::get('blogs/delete', [BlogController::class, 'delete'])->name('blogs.delete');

    // Crop Image
    Route::get('image/create', [ImageContoller::class, 'ImageCreate'])->name('image.create');
    Route::post('image/store', [ImageContoller::class, 'ImageCropAndStore'])->name('image.store');

    // Resize Image
    Route::get('image/resize-create', [ImageContoller::class, 'ResizeImageCreate'])->name('image.resize-create');
    Route::post('image/resize-store', [ImageContoller::class, 'ResizeImageStore'])->name('image.resize-store');
});
