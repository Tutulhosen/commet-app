<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\CategotyController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\ExpertiseController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\VisionController;
use App\Http\Controllers\FrontendController;
use App\Models\Slider;
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
   //admin profile route
   Route::get('admin-user-profile', [ProfileController::class, 'userprofile'])->name('admin.user.profile');
   Route::post('admin-user-edit{id}', [ProfileController::class, 'editProfile'])->name('admin.profile.edit');
   Route::post('admin-user-profile-photo/{id}', [ProfileController::class, 'uploadphoto'])->name('admin.user.profile.photo');
   Route::post('admin-user-password-change/{id}', [ProfileController::class, 'changePassword'])->name('admin.password.change');

   
   //slider route
   Route::resource('slider', SliderController::class);
   Route::get('slider-status-update/{id}', [SliderController::class, 'sliderStatusUpdate'])->name('slider.status.update');

   //testimonial route
   Route::resource('testimonial', TestimonialController::class);
   Route::get('testimonial-status-update/{id}', [TestimonialController::class, 'statusUpdate'])->name('testimonial.status.update');

   //clients route
   Route::resource('client', ClientController::class);
   Route::get('client-status-update/{id}', [ClientController::class, 'clientStatusUpdate'])->name('client.status.update');

   //expertise route
   Route::resource('expertise', ExpertiseController::class);
   Route::get('expertise-status-update/{id}', [ExpertiseController::class, 'expertiseStatusUpdate'])->name('expertise.status.update');

   //vision route
   Route::resource('vision', VisionController::class);
   Route::get('vision-status-update/{id}', [VisionController::class, 'visionStatusUpdate'])->name('vision.status.update');

  //counter route
  Route::resource('counter', CounterController::class);
  Route::get('counter-status-update/{id}', [CounterController::class, 'counterStatusUpdate'])->name('counter.status.update');

  //portfolio category route
  Route::resource('category', CategotyController::class);
  Route::get('category-status-update/{id}', [CategotyController::class, 'categoryStatusUpdate'])->name('category.status.update');

  //portfolio route
  Route::resource('/portfolio', PortfolioController::class);
  Route::get('portfolio-status-update/{id}', [PortfolioController::class, 'portfolioStatusUpdate'])->name('portfolio.status.update');



 });



 /**
  * frontend route
  */

  Route::get('/', [FrontendController::class, 'index'])->name('home.index');
  Route::get('contact', [FrontendController::class, 'contactPageShow'])->name('contact.index');
  Route::get('portfolio-single-page/{slug}', [FrontendController::class, 'portfolioSinglePage'])->name('portfolio.single.page.index');



