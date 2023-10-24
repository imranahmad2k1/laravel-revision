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

Route::get('/', [AuthenticationController::class, 'getUsers']);

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [AuthenticationController::class, 'authenticate'])->name('authenticate');
Route::post('/store', [AuthenticationController::class, 'store'])->name('store');

Route::get('/edit/{id}',function($id){
    $user=User::find($id);
    return view('edit', ['data' => $user]);
})->name('edit');

Route::put('/edit/{user}', [AuthenticationController::class, 'saveRecord']);
Route::get('/delete/{user}', [AuthenticationController::class, 'deleteRecord']);