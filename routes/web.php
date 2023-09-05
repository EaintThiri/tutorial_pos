<?php


use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;

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






Route::middleware(['admin_auth'])->group(function(){
    // login/ register
Route::redirect('/', 'loginPage');
Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});




Route::middleware(['auth'])->group(function () {


    //dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');
    //admin
    // Route::group(['middleware'=>'admin_auth'],function(){})
    Route::middleware(['admin_auth'])->group(function(){
        //Category

    Route::prefix('category')->group(function(){
    Route::get('list',[CategoryController::class,'list'])->name('category#list');
    Route::get('createPage',[CategoryController::class,'createPage'])->name('category#createPage');
    Route::post('create',[CategoryController::class,'create'])->name('category#create');
    Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
    Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
    Route::post('update',[CategoryController::class,'update'])->name('category#update');
        });
        //admin account
        Route::prefix('admin')->group(function(){
            //password
            Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#changePassword');

           //profile
            // account info
            Route::get('details',[AdminController::class,'details'])->name('admin#details');
            //edit
            Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
            // update
            Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');
            //admin list
            Route::get('list',[AdminController::class,'list'])->name('admin#list');
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
            Route::get('change',[AdminController::class,'change'])->name('admin#change');
            Route::get('userContact',[ContactController::class,'userContactList'])->name('admin#userContactList');
         Route::get('detailPage/{id}',[ContactController::class,'detailPage'])->name('user#detailPage');


        });

        Route::prefix('contact')->group(function(){
              Route::get('delete',[ContactController::class,'deleteContact'])->name('user#deleteContact');
        });



        //products
        Route::prefix('product')->group(function(){
            Route::get('list',[ProductController::class,'list'])->name('product#list');
            Route::get('create',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('create',[ProductController::class,'create'])->name('product#create');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
            Route::get('updatePage/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
            Route::post('update',[ProductController::class,'update'])->name('product#update');

        });

        Route::prefix('order')->group(function(){
            Route::get('list',[OrderController::class,"orderList"])->name('order#list');
            Route::get('change/status',[OrderController::class,"changeStatus"])->name('admin#changeStatus');
            Route::get('ajax/change/status',[OrderController::class,'ajaxChangeStatus'])->name("admin#ajaxChangeStatus");
            Route::get('listInfo/{order_code}',[OrderController::class,'listInfo'])->name('admin#listInfo');
            Route::get('delete',[OrderController::class,'deleteOrder'])->name('admin#deleteOrder');
        });
        Route::prefix('user')->group(function(){
            Route::get('list/page',[UserController::class,'listPage'])->name('user#listPage');
            Route::get('delete/page',[UserController::class,'userDelete'])->name('admin#userDelete');

        });



    });


//user
//home
Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
//     Route::get('home',function(){
//         return view('user.home');
//     })->name('user#home');


    Route::get('home',[UserController::class,'home'])->name('user#home');
    Route::get('filterPage/{id}',[UserController::class,'filterPage'])->name('user#filterPage');
    Route::get('history',[UserController::class,'history'])->name('user#history');
    Route::prefix('pizza')->group(function(){
    Route::get('detail/{id}',[UserController::class,'pizzaDetail'])->name('user#pizzaDetail');

    });
    Route::prefix('contact')->group(function(){
        Route::get('contactPage',[ContactController::class,'contactPage'])->name('user#contactPage');
        Route::post('contact/{id}',[ContactController::class,'contact'])->name('user#contact');

    });

    Route::prefix('password')->group(function(){
        Route::get('change',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
        Route::post('change',[UserController::class,'changePassword'])->name('user#changePassword');

    });
    Route::prefix('account')->group(function(){
        Route::get('change',[UserController::class,'accountChangePage'])->name('user#accountChangePage');
        Route::post('change/{id}',[UserController::class,'accountChange'])->name('user#accountChange');
    });

    Route::prefix('cart')->group(function(){
        Route::get('cartList',[UserController::class,'cartList'])->name('user#cartList');

    });

    Route::prefix('ajax')->group(function(){
      Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
      Route::get('addToCart',[AjaxController::class,'addToCart'])->name('user#addToCart');
      Route::get('order',[AjaxController::class,'order'])->name('ajax#Order');
      Route::get('clear/cart',[AjaxController::class,'clearCart'])->name("ajax#clearCart");

      Route::get('clear/product',[AjaxController::class,'clearProduct'])->name('ajax#clearProduct');
      Route::get('increase/view/count',[AjaxController::class,"increaseViewCount"])->name("ajax#increaseViewCount");




    });
 });

});

Route::get('webTesting',function(){
    $data=[
        'message'=>'this is web testing message'
        ];
    return response()->json($data,200);
});
//localhost:8000/webTesting


