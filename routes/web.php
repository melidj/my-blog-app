<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BloggerController;
use App\Http\Controllers\CommenterController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [HomeController::class, 'welcome'])->name('home');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth', 'admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    //can add more
});

Route::middleware('auth', 'blogger')->group(function () {
    Route::get('/blogger/dashboard', [BloggerController::class, 'dashboard'])->name('blogger.dashboard');

    //can add more
});

Route::middleware('auth', 'commenter')->group(function () {
    Route::get('/commenter/dashboard', [CommenterController::class, 'dashboard'])->name('commenter.dashboard');

    //can add more
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');