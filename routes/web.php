<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('index');

//Se não logado
Route::middleware([CheckIsNotLogged::class])->group(function(){
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

//Se logado
Route::middleware([CheckIsLogged::class])->group(function(){
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
