<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GovernorateController;
use App\Http\Controllers\Admin\ProfileController;
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
    //Governorate Routes
    Route::resource('governorates', GovernorateController::class)->except(['show']);
});




