<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ApplyJob;
use App\Models\JobPost;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ApplyJobController extends Controller
{
    public function applied()
    {
        $data = ApplyJob::where('user_id', Auth::user()->id)->with('job')->get();
        return response()->json($data);
    }
    function apply(Request $request, $id)
    {
        $data = new ApplyJob();
        $data->user_id = Auth::user()->id;
        $data->job_post_id = $id;
        $data->apply_date = date('Y-m-d');
        $data->status = 0;
        $data->cover_letter = $request->cover_letter;
        $data->current_salary = $request->current_salary;
        $data->expected_salary = $request->expected_salary;        
        $data->save();

        // return redirect('/job-post/details/'.$id);
    }
    function appliedCandidateProfile($postId,$userId)
    {
        $user = User::find($userId);  
        $jobPost = JobPost::find($postId);      
        return response()->json([
            'user' => $user,
            'jobPost' => $jobPost,
        ]);
    }

    function responseAppliedCandidate(Request $request)
    {        
        $data = ApplyJob::where('job_post_id',$request->jobPostId)
                        ->Where('user_id',$request->userId)->first();                   
        $data->status = $request->selectValue;
        $data->save();
    }

    function candidateAppliedJobs()
    {
        $data = ApplyJob::where('user_id', Auth::user()->id)->with('job')->get();
        return response()->json($data);
    }

    function viewCandidateAppliedJob($id)
    {
        $data = ApplyJob::where('user_id', Auth::user()->id)->with('job')->get();
        return response()->json($data);
    }
}
