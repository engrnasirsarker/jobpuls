<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use App\Models\User;
use Auth;
use DB;

class CandidateController extends Controller
{
    function index(){
        $data = User::where('user_type','candidate')->get();
        return response()->json($data);
    }

    function candidateProfile()
    {
        $data = User::find(Auth::user()->id);
        return response()->json($data);
    }

    function candidateProfileUpdate(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->fname = $request->input('fname');
        $user->mname = $request->input('mname');
        $user->dob = $request->input('dob');
        $user->gender = $request->input('gender');
        $user->religion = $request->input('religion');
        $user->nid = $request->input('nid');
        $user->passport_no = $request->input('passport_no');
        $user->cell_no = $request->input('cell_no');
        $user->emergency_contact_no = $request->input('emergency_contact_no');
        $user->whatsapp = $request->input('whatsapp');
        $user->linkedin = $request->input('linkedin');
        $user->facebook = $request->input('facebook');
        $user->github = $request->input('github');
        $user->dribble_link = $request->input('dribble');
        $user->address = $request->input('address');
        $user->portfolio_link = $request->input('portfolio_link');
        $user->education_info = $request->input('education_info');
        $user->training_info = $request->input('training_info');
        $user->job_experience = $request->input('job_experience');
        $user->skills = $request->input('skills');
        if ($request->image) {
            // Process and save the banner image
            $position = strpos($request->image, ';');
            $sub = substr($request->image, 0 ,$position);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;
            $manager = ImageManager::gd();
            $image = $manager->read($request->image)->resize(400, 400);
            $upload_path = 'assets/images/user/';
            $image_url = $upload_path.$name;
            $image->save($image_url);

            // Remove the previous image from the public directory
            if ($user->image) {
                $old_img = public_path($user->image);
                if (file_exists($old_img)) {
                    unlink($old_img);
                }
            }    
            $user->image = $image_url;
        }
        $user->save();
    }
}
