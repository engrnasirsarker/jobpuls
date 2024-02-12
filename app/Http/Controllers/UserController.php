<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
                    ->orderBy('id','DESC')
                    ->get();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
    }
}
