<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[productController::class,'index'])->name('add.product');
Route::post('insert',[productController::class,'store'])->name('store.product');
Route::get('product-list',[productController::class,'show'])->name('show.product');
// Route::get('update-list',[productController::class,'edit'])->name('edit.product');
Route::get('update/{id?}',[productController::class,'update'])->name('update.product');
Route::post('update-insertion',[productController::class,'updateInsertion'])->name('update.insert');
Route::get('delete/{id?}',[productController::class,'delete'])->name('delete.product');
Route::get('search',[productController::class,'search'])->name('search');
Route::get('category-data',[productController::class,'getData'])->name('get.data');


