<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\RoleController;
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


/**
 * admin redirect middleware
 */

 Route::group(['middleware' => 'admin.redirect'], function(){
     //admin auth route
     Route::get('admin-login', [AdminAuthController::class, 'ShowLoginPage'])->name('admin.login.page');
     Route::post('admin-login', [AdminAuthController::class, 'login'])->name('admin.login');
 });



/**
 * admin middleware route
 */

 Route::group(['middleware' =>'admin'], function(){
    
    //admin page route
    Route::get('admin-dashboard', [AdminPageController::class, 'showDashboard'])->name('admin.dashboard');

    //admin auth route
    Route::get('admin-logout', [AdminAuthController::class, 'logOut'])->name('admin.logout');

    //permission route
    Route::resource('permission', PermissionController::class);

    //role route
    Route::resource('role', RoleController::class);

    //admin user route

   Route::resource('admin-user', AdminUserController::class);
   Route::get('admin-user-status-update/{id}', [AdminUserController::class, 'statusupdate'])->name('admin.user.status.update');
   Route::get('admin-user-trash/{id}', [AdminUserController::class, 'trash'])->name('admin.user.trash');
   Route::get('admin-user-trash-page', [AdminUserController::class, 'trashpage'])->name('admin.user.trash.page');
   Route::get('admin-user-restore/{id}', [AdminUserController::class, 'userrestore'])->name('admin.user.restore');

 });


