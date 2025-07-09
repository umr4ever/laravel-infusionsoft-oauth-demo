<?php

use App\Http\Controllers\InfusionsoftOAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/oauth/redirect', [InfusionsoftOAuthController::class, 'redirectToAuthorization']);
Route::get('/oauth/callback', [InfusionsoftOAuthController::class, 'handleAuthorizationCallback']);
Route::get('/oauth/refresh', [InfusionsoftOAuthController::class, 'refreshToken']);
Route::get('/contacts', [InfusionsoftOAuthController::class, 'getContacts']);
