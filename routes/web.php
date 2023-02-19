<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\UserController;

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

// All list
Route::get('/', [ListController::class, 'index']);

// Create a list
Route::get('/list/create', [ListController::class, 'create'])->middleware('auth');

// Store the list in db
Route::post('/list', [ListController::class, 'store'])->middleware('auth');

// Single list
Route::get('/list/{listing}', [ListController::class, 'show'])->middleware('auth');

// edit a list
Route::get('/list/{listing}/edit', [ListController::class, 'edit'])->middleware('auth');

// udpate list
Route::put('list/{listing}', [ListController::class, 'update'])->middleware('auth');

// delete list
Route::delete('list/{listing}', [ListController::class, 'destroy'])->middleware('auth');

// managed list
Route::get('/listings/manage', [ListController::class, 'manage'])->middleware('auth');
 
//  === user registration ===

// show the registration page
Route::get("/register", [UserController::class, 'create'])->middleware('guest');

// create new user
Route::post("/users/register", [UserController::class, 'store']);

// login existing user
Route::get("/login", [UserController::class, 'login'])->name('login')->middleware('guest');

// create new session for user
Route::post("/users/authenticate", [UserController::class, 'authenticate']);

// logout user
Route::post("/logout", [UserController::class, 'logout'])->middleware('auth');
