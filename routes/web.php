<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();


Route::middleware('auth:sanctum')->group( function () {
    Route::get('/add/childs/html', [UserController::class, 'addChildsHtml'])->name('child.html');
    Route::resource('/user', UserController::class);
    Route::get('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
});


