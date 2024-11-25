<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');


Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('go_absen', [HomeController::class, 'go_absen'])->name('go_absen')->middleware('auth');
Route::get('go_isi', [HomeController::class, 'go_isi'])->name('go_isi')->middleware('auth');
Route::post('import', [HomeController::class, 'import'])->name('import')->middleware('auth');
