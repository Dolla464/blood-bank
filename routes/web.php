<?php

use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonationRequestController;
use App\Http\Controllers\Admin\GovernorateController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Website\Auth\ForgetPasswordController;
use App\Http\Controllers\Website\Auth\LoginController;
use App\Http\Controllers\Website\ContactController as WebsiteContactController;
use App\Http\Controllers\Website\DonationController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\PostController as WebsitePostController;
use App\Http\Controllers\Website\ProfileController as WebsiteProfileController;
use App\Models\Contact;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Auth::routes(['register' => false]);

// website routes
Route::group(['as' => 'website.'], function() {
    Route::get('login', [LoginController::class, 'loginView'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::match(['get','post'], 'register', [LoginController::class, 'register'])->name('register');
    Route::get('/ajax/cities', [LoginController::class, 'fetchCities'])->name('ajax.cities');

    Route::get('forget-password', [ForgetPasswordController::class, 'requestView'])->name('password.request');
    Route::post('forget-password/send', [ForgetPasswordController::class, 'sendToken'])->name('password.send');           
    Route::get('verify-code', [ForgetPasswordController::class, 'resetView'])->name('password.reset');          
    Route::post('verify-code/reset', [ForgetPasswordController::class, 'resetPassword'])->name('password.update');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('articles', [WebsitePostController::class, 'posts'])->name('articles');
    Route::get('/article-details/{id}', [WebsitePostController::class, 'show'])->name('article-details');
    Route::view('/who-are-us', 'website/who-are-us')->name('who-are-us');
    Route::view('/about-app', 'website/about-app')->name('about-app');
    Route::get('/contact-us', [WebsiteContactController::class, 'create'])->name('contact-us');
    Route::post('/contact-us', [WebsiteContactController::class, 'store'])->name('contact-submit');

    Route::group(['middleware' => 'auth:client-web'], function(){
        Route::get('/profile', [WebsiteProfileController::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile', [WebsiteProfileController::class, 'updateProfile'])->name('profile.update');
        Route::get('/profile-donations', [WebsiteProfileController::class, 'profileDonations'])->name('profile.donations');
        Route::get('donation-requests', [DonationController::class, 'index'])->name('donation-requests');
        Route::get('donation-details/{donation}', [DonationController::class, 'show'])->name('donation-details');
        Route::match(['get','post'], '/create-donation', [DonationController::class, 'store'])->name('create-donation');
    });
});

// users
Route::group(['middleware' => ['auth', 'role:user']], function () {
    Route::get('users/home', fn()=> view('users.home'))->name('users.home');
});

Route::prefix('admin')->name('admin.')->group(function () {
    
    Route::get('login', [AuthLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthLoginController::class, 'login'])->name('login.submit');
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])->name('register.submit');
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    Route::post('logout', [AuthLoginController::class, 'logout'])->name('logout');

    Route::middleware(['auth:admin', 'role:admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'home'])->name('dashboard');
        //Profile Routes
        Route::get('/profile/{admin}', [ProfileController::class, 'index'])->name('profile');
        Route::get('profile/edit/{admin}', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile/edit/{admin}', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('profile/delete/{admin}', [ProfileController::class, 'destroy'])->name('profile.delete');
        // Clients Routes
        Route::resource('clients', ClientController::class)->except(['create', 'store', 'edit', 'update']);
        Route::patch('/clients/{client}/status', [ClientController::class, 'updateStatus'])->name('clients.updateStatus');

        //User Routes
        Route::resource('users', UserController::class);
        //Role Routes
        Route::resource('roles', RoleController::class);
        //Governorate Routes
        Route::resource('governorates', GovernorateController::class)->except(['show']);
        //City Routes
        Route::resource('cities', CityController::class);
        //Category Routes
        Route::resource('categories', CategoryController::class);
        //Post Routes
        Route::resource('posts', PostController::class);
        //Donation Request Routes
        Route::resource('donations', DonationRequestController::class)->except(['create', 'store', 'edit', 'update']);
        //Message Routes
        Route::resource('messages', ContactController::class);


    });
});
    




