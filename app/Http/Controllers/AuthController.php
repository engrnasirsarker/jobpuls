<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Hash;
use Auth;

class AuthController extends Controller
{
    function getLogin(){
        return view('auth.login');
    }
    function UserLogin(Request $request){
        try {
            $credentials = $this->validate($request, [
                'email' => 'required|string|email|max:50',
                'password' => 'required|string|min:3'
            ]);
            
            $user = User::where('email', $request->input('email'))->first();
            if ($user->user_type !== 'user') {
                
                return back()->withErrors([
                    'email' => 'Only admin can log in here.',
                ]);
            }
            if (!$user || !Hash::check($request->input('password'), $user->password)) {
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ]);
            }

            if(Auth::attempt($credentials)){            
                $user = Auth::user();
                $token = $user->createToken('authToken')->plainTextToken;
                session()->put('access_token', 'Bearer '.$token);
                return redirect()->intended('/admin');
            }
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }catch (Exception $e){
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }    
    }
    function UserLogout(Request $request)
    {
        // Revoke the user's access token
        $request->user()->tokens()->delete();

        // Remove the access_token from the session
        $request->session()->forget('access_token');

        // Invalidate the session cookie
        $request->session()->invalidate();
        
        // Auth::logout();
        // Redirect the user to the login page
        return redirect()->intended('/admin/login');
    }

    function signup(Request $request)
    {       
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:cpassword',
        ]);
        
        $user = new user();
        if($request->type == 'candidate'){
            $user->user_type = 'candidate';  
        }else if($request->type == 'employer'){
            $user->user_type = 'employer';
        }        
        $user->name = $request->input('first_name').' '.$request->input('last_name');  
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // $user->assignRole($request->input('role_id'));
    }

    function candidateLogin(Request $request){
        try {
            $credentials = $this->validate($request, [
                'email' => 'required|string|email|max:50',
                'password' => 'required|string|min:3'
            ]);
            
            $user = User::where('email', $request->input('email'))->first();
            
            if (!$user) {
                return response()->json(['status' => 'failed', 'message' => 'Invalid User']);
            }
            
            if ($user->user_type !== 'candidate') {
                return response()->json(['status' => 'failed', 'message' => 'Only candidates can log in here.']);
            }
            
            if (!Hash::check($request->input('password'), $user->password)) {
                return response()->json(['status' => 'failed', 'message' => 'Invalid User']);
            }
            
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('authToken')->plainTextToken;
                session()->put('access_token', 'Bearer ' . $token);
                session()->put('requiresAuth', true);
                return redirect()->intended('/front/admin/dashboard');
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Invalid credentials']);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
    function employerLogin(Request $request){
        try {
            $credentials = $this->validate($request, [
                'email' => 'required|string|email|max:50',
                'password' => 'required|string|min:3'
            ]);
            
            $user = User::where('email', $request->input('email'))->first();
            
            if (!$user) {
                return response()->json(['status' => 'failed', 'message' => 'Invalid User']);
            }
            
            if ($user->user_type !== 'employer') {
                return response()->json(['status' => 'failed', 'message' => 'Only employer can log in here.']);
            }
            
            if (!Hash::check($request->input('password'), $user->password)) {
                return response()->json(['status' => 'failed', 'message' => 'Invalid User']);
            }
            
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('authToken')->plainTextToken;
                session()->put('access_token', 'Bearer ' . $token);
                session()->put('requiresAuth', true);
                return redirect()->intended('/front/admin/dashboard');
                
                
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Invalid credentials']);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function employerCandidateLogout(Request $request)
    {
        // Revoke the user's access token
        $request->user()->tokens()->delete();

        // Remove the access_token from the session
        $request->session()->forget('access_token');

        // Invalidate the session cookie
        $request->session()->invalidate();
        
        // Auth::logout();
        // Redirect the user to the login page
        return redirect()->intended('/');
    }
}
