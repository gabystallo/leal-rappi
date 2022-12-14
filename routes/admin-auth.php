<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('admin-login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('admin-logout');


Route::get('/reiniciar-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('admin-password.request');

Route::post('/reiniciar-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('admin-password.email');

Route::get('/reiniciar-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('admin-password.reset');

Route::post('/reiniciar-password/guardar', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('admin-password.update');






Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');


