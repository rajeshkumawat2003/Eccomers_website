<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\frontController;
use App\Http\Controllers\productController;
use App\Http\Controllers\slidercontroller;
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



//login part
Route::get('/login',function(){

    return view('front.login');
});
Route::post('/login',[frontController::class,'login']);
Route::get('/update',[frontController::class,'update']);


//logout
Route::get('/logout',function(){
Session::forget('user');
    return redirect('/login');
});


//detail part
Route::get('/',[frontController::class,'index']);
Route::get('/detail/{id}',[frontController::class,'detail']);
Route::get('/detail_recent/{id}',[frontController::class,'detail_recent']);
Route::POST('/add_to_cart',[frontController::class,'addtocart']);
Route::get('/cartlist',[frontController::class,'cartlist']); 



Route::get('/admin',[AdminController::class,'index']);
Route::post('admin/auth', [AdminController::class, 'auth'])->name('admin.auth');
// Route::get('/update',[AdminController::class,'update']);

Route::group(['middleware' => 'Admin_auth'], function () {
Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

//categary

Route::get('admin/category', [CategoryController::class, 'index'])->name('category');
Route::get('admin/category/manage_category',[CategoryController::class,'manage_category']);
Route::POST('admin/category/manage_category_process', [CategoryController::class,'manage_category_process'])->name('category.manage_category_process');
Route::get('delete/category/{id}',[CategoryController::class,'delete']);
Route::get('edit/category/{id}',[CategoryController::class,'edit']); 
Route::post('update/category/{id}',[CategoryController::class,'update']); 

//product

Route::get('admin/product', [productController::class, 'index'])->name('product');
Route::get('admin/product/manage_product',[productController::class,'manage_product']);
Route::POST('admin/product/manage_product_process', [productController::class,'manage_product_process'])->name('product.manage_product_process');
Route::get('delete/product/{id}',[productController::class,'delete']);
Route::get('edit/product/{id}',[productController::class,'edit']); 
Route::post('update/product/{id}',[productController::class,'update']); 

//slide

Route::get('admin/slider', [slidercontroller::class, 'index'])->name('slider');
Route::get('admin/slider/manage_slider',[slidercontroller::class,'manage_slider']);
Route::POST('admin/slider/manage_slider_process', [slidercontroller::class,'manage_slider_process'])->name('slider.manage_slider_process');
Route::get('delete/slider/{id}',[slidercontroller::class,'delete']);
Route::get('edit/slider/{id}',[slidercontroller::class,'edit']); 
Route::post('update/slider/{id}',[slidercontroller::class,'update']); 




Route::get('admin/logout', function () {
    session()->forget('ADMIN_LOGIN');
    session()->forget('ADMIN_ID');
    session()->flash('error', 'Logout successfully');
    return redirect('admin');   
     }); 
}); 

