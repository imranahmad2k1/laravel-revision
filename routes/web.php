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
Route::get('/users', [AuthenticationController::class, 'index']);
Route::get('/users/all', [AuthenticationController::class, 'getAllUsers'])->name('get-all-users');
Route::post('/users/create', [AuthenticationController::class, 'createUser'])->name('store');
Route::get('/users/{id}',[AuthenticationController::class, 'getUser'])->name('getuser');
Route::post('/users/{id}', [AuthenticationController::class, 'updateRecord'])->name('edituser');
Route::delete('/users/{id}', [AuthenticationController::class, 'deleteRecord'])->name('deleteuser');


// -----IRRELEVANT TO CRUD---
Route::post('/login', [AuthenticationController::class, 'authenticate'])->name('authenticate');
Route::view('/login','login');