<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Laravel\Fortify\Fortify;
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

Route::get('/admin/login', [AuthController::class, 'getLogin']);
Route::post('/admin/login', [AuthController::class, 'UserLogin'])->name('admin.login');
Route::post('/candidate/login', [AuthController::class, 'candidateLogin']);
Route::post('/employer/login', [AuthController::class, 'employerLogin']);

Route::post('/admin/logout',[AuthController::class,'UserLogout'])
        ->name('logout')->middleware('auth:sanctum');
Route::post('/employer/candidate/logout',[AuthController::class,'employerCandidateLogout'])
        ->middleware('auth:sanctum');


Route::get('/admin/{any?}', function () {
    return view('app');
})->where('any', '[\/\w\.-]*')->middleware('auth:sanctum');

Route::get('/{any?}', function () {
    return view('home');
})->where('any', '[\/\w\.-]*');
