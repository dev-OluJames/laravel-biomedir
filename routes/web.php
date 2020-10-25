<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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

Route::get('index', [HomeController::class,'index']);

Route::get('login', [AuthController::class, 'index']);
Route::post('post-login', [AuthController::class, 'postLogin']);
Route::get('register', [AuthController::class, 'register']);
Route::post('post-register', [AuthController::class, 'postRegister']);
Route::get('dashboard', [AuthController::class, 'dashboard']);
Route::get('logout', [AuthController::class, 'logout']);

Route::view('no_access','no_access');


Route::post('add_new/{slug}', [AdminController::class,'addArticle'])->middleware('user_protct_page');
Route::get('add_new/{slug}', [AdminController::class,'preAddArticle'])->middleware('user_protct_page');




Route::view('add_categories','admin.addcategories')->middleware('user_protct_page');
Route::post('add_categories', [AdminController::class,'addCategory'])->middleware('user_protct_page');

Route::get('sub_categories/{slug}',[AdminController::class,'preAddSubCategory'])->middleware('user_protct_page');
Route::post('sub_categories/{slug}', [AdminController::class,'addSubCategory'])->middleware('user_protct_page');


Route::get('categories', [AdminController::class,'listCategory']);

Route::get('show_categories/{slug}', [AdminController::class,'showCategory'])->name('categorie');
Route::post('show_categories/{slug}', [AdminController::class,'editCategory']);

Route::get('show_article/{slug}',[AdminController::class,'show_article']);
Route::get('edit/{slug}',[AdminController::class,'preEdit_article']);
Route::post('edit/{slug}',[AdminController::class,'edit_article']);
Route::get('delete/{id}',[AdminController::class,'delete_article']);
Route::get('contact',[AdminController::class,'contact']);
Route::post('contact',[AdminController::class,'send_email']);

Route::get('product',[HomeController::class,'product']);




