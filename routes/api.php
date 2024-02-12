<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ShiftController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentGroupController;
use App\Http\Controllers\StudentCategoryController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\StudentSubjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RolePermissionsController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('users', App\Http\Controllers\UserController::class)->middleware('auth:sanctum');

Route::group(['middleware' => 'auth:sanctum'], function () {
    /*-----------------------------
        role permission route
    --------------------------------*/ 
    Route::controller(RolePermissionsController::class)->group(function(){
        Route::get('/roles', 'index');
        Route::get('/permissions', 'permissions');
        Route::post('/role', 'storeRole');
        Route::get('/role/{role}', 'editRole');
        Route::put('/role/{id}', 'updateRole');
        Route::delete('/role/{id}', 'destroy');
        Route::post('/student-class', 'classStore');
    });
    Route::apiResource('/shift', ShiftController::class)->except('show','edit','create');
    Route::apiResource('/section', SectionController::class)->except('show','edit','create');
    Route::apiResource('/session', SessionController::class)->except('show','edit','create');
    Route::apiResource('/student-subject',StudentSubjectController::class)->except('show','edit','create');
    Route::apiResource('/student-group',StudentGroupController::class)->except('show','edit','create');
    Route::apiResource('/student-category',StudentCategoryController::class)->except('show','edit','create');
    Route::apiResource('/student-class',StudentClassController::class)->except('show','edit','create');
    Route::apiResource('/student', StudentController::class);
    Route::apiResource('/user',UserController::class);
    
});