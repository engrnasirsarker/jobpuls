<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RolePermissionsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PluginsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
// frontend route
use App\Http\Controllers\frontend\JobPostController;
use App\Http\Controllers\frontend\ApplyJobController;
use App\Http\Controllers\frontend\HomeController;
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
// Route::apiResource('users', App\Http\Controllers\UserController::class)->middleware('auth:sanctum');

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
    // Home Route     
    
    Route::apiResource('/user',UserController::class)->except(['show']);
    Route::get('/user/account',[UserController::class,'userAccount']);
    // change password route
    Route::post('/user/check/password',[UserController::class,'checkOldPassword']);
    Route::post('/user/change/password',[UserController::class,'changePassword']);
    
    Route::apiResource('/job-category',JobCategoryController::class);
    Route::get('/jobs',[JobController::class,'index']);
    Route::patch('/job/{job}',[JobController::class,'update']);

    Route::post('/contact',[PageController::class,'updateContact']);

    Route::post('/about',[PageController::class,'updateAbout']);

    // frontend route
    Route::get('/dashboard/data', [DashboardController::class, 'dashboardData']);
    Route::get('/companies',[CompanyController::class, 'index']);
    Route::get('/candidates',[CandidateController::class, 'index']);
    Route::get('/candidate/profile',[CandidateController::class, 'candidateProfile']);
    Route::post('/candidate/profile/update',
        [CandidateController::class, 'candidateProfileUpdate']
    );

    Route::get('/job-post',[JobPostController::class,'index']);
    Route::post('/job-post',[JobPostController::class,'storeJobPost']);

    Route::get('/job-post/{id}',[JobPostController::class,'show']);
    
    Route::patch('/job-post/{id}',[JobPostController::class,'update']);
    Route::delete('/job-post/{id}',[JobPostController::class,'destroy']);
    
    Route::get('/applied/jobs',[ApplyJobController::class,'applied']);
    Route::post('/job/apply/{id}',[ApplyJobController::class,'apply']);

    Route::get('/candidate/applied/jobs',
        [ApplyJobController::class,'candidateAppliedJobs']
    );
    Route::get('/applied/candidate/profile/{postId}/{userId}',
        [ApplyJobController::class,'appliedCandidateProfile']
    );
    // for status change
    Route::post('/applied/candidate/response',
        [ApplyJobController::class,'responseAppliedCandidate']
    );

    Route::put('/plugins/{resource}/toggle-active', 
        [PluginsController::class,'toggleActive']
    );

    Route::get('/plugins/status', [PluginsController::class,'getStatus']);
    Route::apiResource('/blogs', BlogController::class);
});

// frontend route
Route::post('/signup', [AuthController::class,'signup']);

Route::get('/contact',[PageController::class,'getContact']);
Route::get('/about',[PageController::class,'getAbout']);

Route::get('recent/published/jobs', 
        [HomeController::class, 'recentPublishedJobs']
);
Route::get('/front/dashboard/data', 
        [HomeController::class, 'dashboard']
);
Route::get('top-company', 
        [HomeController::class, 'getTopCompany']
);
Route::get('all/published/jobs', 
        [JobPostController::class, 'allPublishedJobs']
);
Route::get('/job-post/details/{id}',
    [JobPostController::class,'jobPostDetails']
);
Route::get('/applied/jobs/{id}',
    [JobPostController::class,'appliedJob']
);

Route::get('/front/blogs', [BlogController::class,'getFrontBlogs']);
Route::get('/front/blog/{id}', [BlogController::class,'getFrontBlog']);

