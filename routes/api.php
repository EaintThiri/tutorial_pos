<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RouteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('apiTesting',function(){
    $data=[
        'message'=>'this is api testing message'
        ];
    return response()->json($data,200);
});
//localhost/api/apiTesting
//Get
Route::get('product/list',[RouteController::class,'productList'])->name('api#productList');
Route::get('category/list',[RouteController::class,'categoryList']);
Route::get('category/delete/{id}',[RouteController::class,'categoryDelete']);
Route::get('category/list/{id}',[RouteController::class,'categoryDetails']);



//Post
Route::post('create/category',[RouteController::class,'categoryCreate']);
Route::post('create/contact',[RouteController::class,'contactContact']);
//Route::post('category/delete/{id}',[RouteController::class,'categoryDelete']);
// Route::post('details/category',[RouteController::class,'categoryDetails']);
Route::post('update/category',[RouteController::class,'updateCategory']);




// product list
// localhost:8000/api/product/list
// category list
// localhost:8000/api/category/list
//create category
//localhost:8000/api/create/category (post)
//body{
 //   name:""
//
//}
