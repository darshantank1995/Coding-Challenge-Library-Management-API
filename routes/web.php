<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\FormController::class, 'index'])->name('index');
Route::post('/save', [App\Http\Controllers\FormController::class, 'save'])->name('save');
Route::get('/student/{id}', [App\Http\Controllers\FormController::class, 'edit'])->name('edit');