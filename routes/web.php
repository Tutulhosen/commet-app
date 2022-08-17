<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//admin auth route
Route::get('admin-login', [AdminAuthController::class, 'ShowLoginPage'])->name('admin.login.page');
Route::post('admin-login', [AdminAuthController::class, 'login'])->name('admin.login');


//admin page route
Route::get('admin-dashboard', [AdminPageController::class, 'showDashboard'])->name('admin.dashboard');