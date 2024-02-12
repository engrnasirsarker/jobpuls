<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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


Route::post('/login', [AuthController::class, 'UserLogin']);

Route::post('/logout',[AuthController::class,'UserLogout'])
        ->name('logout')->middleware('auth:sanctum');

Route::get('/admin/{any?}', function () {
    return view('app');
})->where('any', '[\/\w\.-]*')->middleware('auth');

Route::get('/{any?}', function () {
    return view('home');
})->where('any', '[\/\w\.-]*');