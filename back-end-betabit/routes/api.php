<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Src\Contacts\Infra\Controllers\CreateContact\CreateContactController;
use Src\Contacts\Infra\Controllers\DeleteContact\DeleteContactController;
use Src\Contacts\Infra\Controllers\GetContact\GetContactController;
use Src\Contacts\Infra\Controllers\UpdateContact\UpdateContactController;
use Src\Users\Infra\Controllers\Auth\LoginController;
use Src\Users\Infra\Controllers\Auth\LogoutController;
use Src\Users\Infra\Controllers\User\CreateUserController;

Route::post('/user', [CreateUserController::class, 'execute']);
Route::post('/login', [LoginController::class, 'execute']);
Route::middleware('auth:sanctum')->post('/logout', [LogoutController::class, 'execute']);
Route::middleware('auth:sanctum')->post('/contact', [CreateContactController::class, 'execute']);
Route::middleware('auth:sanctum')->post('/contact/update', [UpdateContactController::class, 'execute']);
Route::middleware('auth:sanctum')->delete('/contact/{id}', [DeleteContactController::class, 'execute']);
Route::middleware('auth:sanctum')->get('/contact/{id?}', [GetContactController::class, 'execute']);

Route::middleware('auth:sanctum')->post('/bla', function (Request $request) {
    $user = $request->user()->id;
    return $user;
});

