<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPost;
use App\Models\ApplyJob;
use Auth;

class JobPostController extends Controller
{
    function index()
    {
        $data = JobPost::where('user_id', Auth::user()->id)->get();
        return response()->json($data);
    }
    public function allPublishedJobs(Request $request)
{
    $perPage = $request->has('per_page') ? $request->per_page : 5; // Number of items per page

    $marketings = JobPost::where('status', 'Approved')
                    ->where('job_category', 'Marketing')
                    ->paginate($perPage); 
    $marketingsCount = JobPost::where('status', 'Approved')
                    ->where('job_category', 'Marketing')
                    ->count('id');

    $projectManagements = JobPost::where('status', 'Approved')
                    ->where('job_category', 'Project Management')
                    ->paginate($perPage);
    $projectManagementsCount = JobPost::where('status', 'Approved')
                    ->where('job_category', 'Project Management')
                    ->count('id');

    $businessManagements = JobPost::where('status', 'Approved')
                    ->where('job_category', 'Business Management')
                    ->paginate($perPage);   
    $businessManagementsCount = JobPost::where('status', 'Approved')
                    ->where('job_category', 'Business Management')
                    ->count('id');    

    $educations = JobPost::where('status', 'Approved')
                    ->where('job_category', 'Education')
                    ->paginate($perPage); 

    $programming_ITs = JobPost::where('status', 'Approved')
                    ->where('job_category', 'Programming & IT')
                    ->paginate($perPage); 

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

    function storeJobPost(Request $request)
    {
        $skills = implode(' ', $request->input('skills'));
        $data = new JobPost();
        $data->user_id = Auth::user()->id;
        $data->job_title = $request->job_title;
        $data->job_description = $request->job_description;
        $data->job_location = $request->job_location;
        $data->job_category = $request->job_category;
        $data->job_type = $request->job_type;
        $data->job_experience = $request->job_experience;
        $data->skills = $skills;
        $data->job_deadline = $request->job_deadline;
        $data->job_salary = $request->job_salary;
        $data->save();
        return response()->json($data);
    }

    function show($id)
    {
        $data = JobPost::find($id);
        return response()->json(['job' => $data]);
    }

    function update(Request $request, $id)
    { 
        $skills = $request->input('skills');
        // Check if skills is an array
        if (is_array($skills)) {
            $skills = implode(' ', $skills);
        } else {
            $skills = '';
        }

        $data = JobPost::find($id);
        $data->job_title = $request->job_title;
        $data->job_description = $request->job_description;
        $data->job_location = $request->job_location;
        $data->job_category = $request->job_category;
        $data->job_type = $request->job_type;
        $data->job_experience = $request->job_experience;
        $data->skills = $skills;
        $data->job_deadline = $request->job_deadline;
        $data->job_salary = $request->job_salary;
        $data->save();
    }


    function destroy($id)
    {
        $data = JobPost::find($id);
        $data->delete();
    }
    function recentPublishedJob()
    {
        $data = JobPost::where('user_id', Auth::user()->id)->get();
        return response()->json($data);
    }
    function jobPostDetails($id)
    {
        $data = JobPost::find($id);
        $totalApply = ApplyJob::where('job_post_id', $data->id)->count('id');
        return response()->json(
            [
                'job' => $data,
                'totalApply' => $totalApply
            ]
        );
    }
    function appliedJob($id)
    {
        $data = JobPost::find($id);
        $appliedJobs = ApplyJob::where('job_post_id', $data->id)->with('user')->get();
        return response()->json(
            [
                'job' => $data,
                'appliedJobs' => $appliedJobs
            ]
        );
    }


}
