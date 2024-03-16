<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPost;
use App\Models\ApplyJob;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    function recentPublishedJobs()
    {
        $data = JobPost::where('status', 'Approved')->get();
    
        $marketings = $data->where('job_category', 'Marketing'); 
        $marketingsCount = $marketings->count('id');
        $projectManagements = $data->where('job_category', 'Project Management'); 
        $projectManagementsCount = $projectManagements->count('id');
        $businessManagements = $data->where('job_category', 'Business Management'); 
        $businessManagementsCount = $businessManagements->count('id');
        $educations = $data->where('job_category', 'Education'); 
        $programming_ITs = $data->where('job_category', 'Programming & IT'); 
        
        return response()->json([
            'marketings' => $marketings,
            'projectManagements' => $projectManagements,
            'businessManagements' => $businessManagements,
            'educations' => $educations,
            'programming_ITs' => $programming_ITs,
            'marketingsCount' => $marketingsCount,
            'projectManagementsCount' => $projectManagementsCount,
            'businessManagementsCount' => $businessManagementsCount,
        ]);
    }

    function getTopCompany()
    {
        $data = User::where('user_type','employer')->take(5)->get();
        return response()->json($data);
    }

    function dashboard()
    {
        $totalAppliedJob = ApplyJob::count('id');        
        return response()->json($totalAppliedJob);
    }
}
