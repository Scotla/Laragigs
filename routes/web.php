<?php

use Illuminate\Support\Facades\Route;
use App\Models\Listing;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});


// -----SHOW ALL LISTINGS--------------------
Route::get('/listings', [ListingController::class, 'index']);

// -----SHOW CREATE VIEW----------------------
Route::get('/listings/create',[ListingController::class, 'create']);

// -----STORE lISTING RECORD------------------
Route::post('/listings', [ListingController::class, 'store']);

// --------MANAGE LISTINGS--------------------
Route::get('/listings/manage', [ListingController::class,'manage']);

// -----EDIT A LISTING------------------------
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);

//------UPDATE A LISTING----------------------
Route::put('/listings/{listing}', [ListingController::class, 'update']);

// -----SHOW SINGLE LISTING-------------------
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// ---------DELETE A LISTING------------------
Route::delete('/listings/{listing}', [ListingController::class, 'destroy']);
  
// ---------SHOW REGISTER CREATE FORM---------
Route::get('/register', [UserController::class, 'create']);

//---------CREATE NEW USER--------------------
Route::post('/register', [UserController::class, 'store']);

// --------LOG USER OUT-----------------------
Route::post('/logout',[UserController::class, 'logout']);

// --------SHOW USER LOGIN FORM ---------------
Route::get('/login',[UserController::class, 'login']);

// --------LOG IN USER------------------------
Route::post('/users/authenticate',[UserController::class, 'authenticate']);



// Route::post('/listings', function(){
//     return view('listings.index');
// });
