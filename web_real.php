<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::get('/actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/go_absen', [HomeController::class, 'go_absen'])->name('go_absen')->middleware('auth');
Route::get('/go_isi', [HomeController::class, 'go_isi'])->name('go_isi')->middleware('auth');
Route::post('/import', [HomeController::class, 'import'])->name('import')->middleware('auth');
Route::post('/store', [HomeController::class, 'store'])->name('store')->middleware('auth');
Route::delete('/destroy/{id}', [HomeController::class, 'destroy'])->name('destroy')->middleware('auth');
Route::get('/go_link', [HomeController::class, 'go_link'])->name('go_link')->middleware('auth');
Route::put('/update_link', [HomeController::class, 'update_link'])->name('update_link')->middleware('auth');
