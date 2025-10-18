<?php

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
use App\Models\Contact;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function (){
    Auth::routes();
    Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'home'])->name('dashboard');});
    //Profile Routes
    Route::get('/profile/{admin}', [ProfileController::class, 'index'])->name('admin.profile');
    Route::get('profile/edit/{admin}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/edit/{admin}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile/delete/{admin}', [ProfileController::class, 'destroy'])->name('admin.delete');
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




