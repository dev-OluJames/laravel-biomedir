<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
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


Route::post('add_new/{slug}', [ArticleController::class,'addArticle'])->middleware('user_protct_page');
Route::get('add_new/{slug}', [ArticleController::class,'preAddArticle'])->middleware('user_protct_page');




Route::view('add_categories','admin.addcategories')->middleware('user_protct_page');
Route::post('add_categories', [CategoryController::class,'addCategory'])->middleware('user_protct_page');

Route::get('sub_categories/{slug}',[CategoryController::class,'preAddSubCategory'])->middleware('user_protct_page');
Route::post('sub_categories/{slug}', [CategoryController::class,'addSubCategory'])->middleware('user_protct_page');


Route::get('categories', [CategoryController::class,'listCategory']);

Route::get('show_categories/{slug}', [CategoryController::class,'showCategory'])->name('categorie');
Route::post('show_categories/{slug}', [CategoryController::class,'editCategory']);

Route::get('show_article/{slug}',[ArticleController::class,'show_article']);
Route::get('edit/{slug}',[ArticleController::class,'preEdit_article']);
Route::post('edit/{slug}',[ArticleController::class,'edit_article']);
Route::get('delete/{id}',[ArticleController::class,'delete_article']);
Route::get('contact',[AdminController::class,'contact']);
Route::post('contact',[AdminController::class,'send_email']);

Route::get('product',[HomeController::class,'product']);

Route::view('admins','admin.admins');

Route::get('admins',[AdminController::class,'admins'])->middleware('admin_protect_page');

Route::get('admin/{slug}/{id}',[AdminController::class,'showAdmin'])->middleware('admin_protect_page');
Route::post('admin/{slug}/{id}',[AdminController::class,'editAdmin'])->middleware('admin_protect_page');

Route::get('account/{slug}/{id}',[UserController::class,'userAccount']);//->middleware('admin_protect_page');
Route::post('account/{slug}/{id}',[UserController::class,'editAccount']);//->middleware('admin_protect_page');



