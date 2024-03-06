<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\JwtAuthVal;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'user.index');
Route::view('/login','auth.form');
Route::view('/dashboard','admin.dashboard');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [AuthController::class, 'register']);
Route::middleware(JwtAuthVal::class)->group(function () {
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
