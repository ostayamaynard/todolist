<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodolistController;

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

Route::get('/',[TodolistController::class, 'index']) ;

Route::post('/saveItem', [TodolistController::class,'saveItem'])->name('saveItem');
Route::post('/markComplete/{id}', [TodolistController::class, 'markComplete'])->name('markComplete');
Route::get('/show/{id}', [TodlistController::class,'show'])->name('show');
