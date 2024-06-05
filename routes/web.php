<?php

use App\Models\product;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderlistController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\userController;
use App\Models\orderlist;

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

Route::redirect('/','/loginPage');
Route::get('/loginPage',[authController::class,'loginPage'])->name('auth#login');
Route::get('/RegisterPage',[authController::class,'RegisterPage'])->name('auth#register');
Route::middleware([
    'auth'
])->group(function () {
    Route::group(['prefix'=>'category','middleware'=>'admin_auth'],function(){
        Route::get('list', [CategoryController::class,'list'])->name('admin#cate');
        Route::get('create',[CategoryController::class,'createPage'])->name('admin#createPage');
        Route::post('create',[CategoryController::class,'create'])->name('admin#create');
        Route::get('edit/{id}',[CategoryController::class,'edit'])->name('admin#edit');
        Route::post('update',[CategoryController::class,'update'])->name('admin#update');
        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('admin#delete');
        Route::prefix('admin')->group(function(){

        });
    });

    Route::middleware('admin_auth')->group(function(){
         Route::prefix('admin')->group(function(){
            Route::get('changepasswordPage',[authController::class,'changePage'])->name('admin#password');
            Route::post('Change',[authController::class,'Change'])->name('admin#Change');
            //admin driect details
            Route::get('details',[authController::class,'details'])->name('admin#details');
            Route::get('edit',[adminController::class,'editProfile'])->name('admin#editProfile');
            Route::post('update/{id}',[adminController::class,'update'])->name('Adminprofile#update');
            Route::get('list/',[adminController::class,'adminlist'])->name('admin#list');
            Route::get('account/delete/{id}',[adminController::class,'adminaccdelete'])->name('adminacc#delete');
            Route::get('orderlist',[adminController::class,'adminOrder'])->name('order#list');
            Route::get('status',[AjaxController::class,'status'])->name('status#order');
            Route::get('order/eachorder/{orderCode}',[OrderlistController::class,'orderlist'])->name('admin#order');
            Route::get('status/update',[AjaxController::class,'statusUpdate'])->name('status#update');
            Route::get('user/list',[adminController::class,'userlist'])->name('admin#userlist');
            Route::get('user/Role',[adminController::class,'userRole'])->name('admin#ChangeRole');
            Route::get('users/profile/{id}',[adminController::class,'usersProfile'])->name('admin#usersProfile');
            Route::get('users/update/{id}',[adminController::class,'updateuser'])->name('admin#userupdate');
         });
         Route::prefix('product')->group(function(){
            Route::get('adminpizza',[ProductController::class,'productlist'])->name('product#list');
            Route::get('createPage',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('create',[ProductController::class,'create'])->name('product#create');
            Route::get('editPage/{id}',[ProductController::class,'editPage'])->name('product#edit');
            Route::get('detailsPage/{id}',[ProductController::class,'details'])->name('product#details');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::post('update',[ProductController::class,'update'])->name('product#update');

         });
    });
  Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
      Route::get('list',[userController::class,'Page'])->name('user#cate');
      Route::get('direct',[userController::class,'DCart'])->name('userdirect#cart');
      Route::get('pizza/{id}',[userController::class,'detailsPage'])->name('user#product#details');
      Route::get('changePage',[userController::class,'ChangePage'])->name('user#changePage');
      Route::post('change',[userController::class,'Change'])->name('user#Change');
      Route::get('details',[userController::class,'details'])->name('user#details');
      Route::get('history',[userController::class,'history'])->name('user#history');
      Route::get('profile',[userController::class,'profile'])->name('user#profile');
      Route::post('Update/{id}',[userController::class,'UpdateAcc'])->name('update#Account');
      Route::get('filter/{id}',[userController::class,'filter'])->name('user#category');
      Route::get('Contact',[userController::class,'Contact'])->name('user#Contact');
      Route::post('Contact/insert',[userController::class,'insert'])->name('Contact#insert');
      Route::prefix('ajax')->group(function(){
        Route::get('pizzalist',[AjaxController::class,'pizzalist'])->name('pizza#list');
        Route::get('/addtoCart',[AjaxController::class,'addtoCart'])->name('user#addCart');
        Route::get('/orderList',[AjaxController::class,'OrderList'])->name('Order#list');
        Route::get('ClearCart',[AjaxController::class,'ClearCart'])->name('Clear#Cart');
        Route::get('removeCart',[AjaxController::class,'removeCart'])->name('Remove#Cart');
        Route::get('increase/view',[AjaxController::class,'increaseView']);
          });
          Route::get('/Cart',[userController::class,'Cart'])->name('user#Cart');
  });

});
Route::get('dashboard',[authController::class,'dashboard'])->name('dashboard');
