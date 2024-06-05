<?php

use App\Http\Controllers\API\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/apiTesting',function(){
    $data=[
   'message' =>'This is testing message'
    ];
    return response()->json($data,200);
});
Route::get('product/list',[RouteController::class,'productlist']);
Route::get('Category/list',[RouteController::class,'Categorylist']);
Route::get('users/list',[RouteController::class,'userlist']);
Route::get('order/list',[RouteController::class,'orderlist']);
Route::get('Cart/list',[RouteController::class,'Cartlist']);
Route::get('rating/list',[RouteController::class,'ratelist']);

//post
Route::post('Category/create',[RouteController::class,'createCategory']);
Route::post('Contact/create',[RouteController::class,'createContact']);

//delete
Route::get('Delete/category/{id}',[RouteController::class,'deleteCategory']);

//edit and update
Route::get('category/list/{id}',[RouteController::class,'editCategory']);
Route::post('category/update',[RouteController::class,'updateCategory']);
