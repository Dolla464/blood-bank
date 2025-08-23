<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ContactUsController;
use App\Http\Controllers\Api\V1\DonationRequestController;
use App\Http\Controllers\Api\V1\GeneralController;
use App\Http\Controllers\Api\V1\NotificationController;
use App\Http\Controllers\Api\V1\NotificationSettingsController;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\ProfileController;
use App\Http\Controllers\Api\V1\ResetPasswordController;
use App\Models\DonationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'password'], function(){
        Route::post('send-code', [ResetPasswordController::class, 'sendResetCode']);
        Route::post('verify-reset', [ResetPasswordController::class, 'verifyCode']);
    });

    Route::get('blood-types', [GeneralController::class, 'bloodTypes']);
    Route::get('governorates', [GeneralController::class, 'governorates']);
    Route::get('cities', [GeneralController::class, 'cities']);
    Route::get('settings', [GeneralController::class, 'settings']);
    Route::get('posts', [PostController::class, 'index']);
    Route::get('posts/{post}', [PostController::class, 'showPost']);


    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => ['auth:api']], function () {
        Route::apiResource('donation-requests', DonationRequestController::class);
        Route::post('posts/{post}/toggle-favorite', [PostController::class, 'toggleFavorite']);
        Route::post('contactus', [ContactUsController::class, 'storeMessage']);
        Route::get('notification-settings', [NotificationSettingsController::class, 'show']);
        Route::post('notification-settings', [NotificationSettingsController::class, 'update']);
        Route::get('profile', [ProfileController::class,'showProfile']);
        Route::post('profile', [ProfileController::class, 'updateProfile']);
        Route::get('notifications', [NotificationController::class, 'index']);
    });

});
