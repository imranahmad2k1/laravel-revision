<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Models\User;
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

Route::get('/users/all', [AuthenticationController::class, 'getAllUsers']);
Route::post('/users/create', [AuthenticationController::class, 'createUser'])->name('store');
Route::get('/users/{id}',[AuthenticationController::class, 'getUser'])->name('getuser');
Route::patch('/users/{id}', [AuthenticationController::class, 'updateRecord']);
Route::get('/users/delete/{id}', [AuthenticationController::class, 'deleteRecord']);


// -----IRRELEVANT TO CRUD---
Route::post('/login', [AuthenticationController::class, 'authenticate'])->name('authenticate');
Route::view('/login','login');