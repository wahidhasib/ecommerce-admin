<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\auth\ResetPasswordController;
use App\Http\Controllers\backend\BackendPageController;
use App\Http\Controllers\frontend\FrontendController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Frontend Pages
|--------------------------------------------------------------------------
| Routes for public pages like home, login, and register.
| Apply 'guest' middleware for login page so authenticated users
| can't access it.
*/

Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('home'); // Home page
    Route::get('/login', 'login')->middleware('guest')->name('login'); // Login page
    Route::get('/register', 'register')->name('register'); // Registration page
});

/*
|--------------------------------------------------------------------------
| Guest (Auth) Routes
|--------------------------------------------------------------------------
| Routes accessible only to guests (unauthenticated users)
| Handles login and registration form submissions.
*/
Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::post('/login', 'loginData')->name('loginData'); // Process login
    Route::post('/register', 'register')->name('register'); // Process registration
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
| Routes accessible only to authenticated users.
| Handles logout functionality.
*/
Route::middleware('auth')->group(function () {
    Route::delete('/logout/{id}', [AuthController::class, 'logout'])->name('logout'); // Logout
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| Routes for admin users only.
| Uses 'auth' + 'role:admin' middleware.
| Names are prefixed with 'admin.' for consistency.
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->controller(BackendPageController::class)
    ->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard'); // Admin dashboard
        // Add more admin routes here in the future
    });

/*
|--------------------------------------------------------------------------
| Password Reset Routes
|--------------------------------------------------------------------------
| Handles forgot-password and reset-password functionality.
| Only accessible to guests.
| Routes:
| - GET /forget-password => show form to enter email
| - POST /forget-password => send reset email
| - GET /reset-password/{token}/{email} => show password reset form
| - POST /reset-password => update password
*/
Route::controller(ResetPasswordController::class)->middleware('guest')->group(function () {
    Route::get('/forget-password', 'forgotPasswordPage')->name('forgotPasswordPage'); // Show forgot-password form
    Route::post('/forget-password', 'forgetPassword')->name('forgetPassword'); // Send reset email
    Route::get('/reset-password/{token}/{email}', 'showResetForm')->name('showResetForm'); // Show reset form
    Route::post('/reset-password', 'resetPassword')->name('resetPassword'); // Update password
});
