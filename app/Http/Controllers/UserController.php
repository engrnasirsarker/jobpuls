<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use App\Models\User;
use Auth;
use Hash;
use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::with('roles')
                    ->where('user_type','user')
                    ->orderBy('id','DESC')
                    ->get();
        return response()->json($data);
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:cpassword',
        ]);
        
        $user = new user();
        $user->user_type = 'user';  
        $user->name = $request->input('name');  
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        $user->assignRole($request->input('role_id'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    /**
     * Display the specified resource.
     */
    public function userAccount()
    {
        $user = \Auth::user();
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {   
        $this->validate($request, [ 
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'password' => 'same:cpassword',
        ],[
            // custome message
            'password.same' => 'The password field must match with confirm password.',            
        ]);
        
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if(!empty($request->password)){ 
            $user->password = Hash::make($request->password);
        }
        $user->save();
        DB::table('model_has_roles')->where('model_id',$request->id)->delete();
    
        $user->assignRole($request->input('role_id'));
    }

    // check current password
    public function checkOldPassword(Request $request)
    {     
        $user = auth()->user();
        if (Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'Current password is correct.']);
        } else {
            return response()->json(['error' => 'Current password is incorrect.'], 422);
        }

    }

    // change password of auth user 
    public function changePassword(Request $request)
    {
        $user = Auth::user();
        if($request->current_password){
            $validatedData = $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|string|min:6|confirmed',
            ]);
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
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json(['error' => 'Current password is incorrect'], 422);
            }
            $user->update([
                'password' => Hash::make($request->new_password),
                'name' => $request->name,
            ]);
    
        }
        return response()->json(['message' => 'Password updated successfully']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
    }
}
