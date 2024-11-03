<?php

use App\Models\Crud;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {

  return view('welcome');
});

//Route::get('/',[CrudController::class,'showData']);
Route::get('/add-data',[CrudController::class,'addData']);
Route::get('/search',[CrudController::class,'searchData']);
Route::post('/store-data',[CrudController::class,'storeData']);
Route::get('/edit-data/{id}',[CrudController::class,'editData']);
Route::post('/update-data/{id}',[CrudController::class,'updateData']);
Route::get('/delete-data/{id}',[CrudController::class,'deleteData']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
