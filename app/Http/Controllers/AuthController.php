<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Hash;
use Auth;

class AuthController extends Controller
{
    function UserLogin(Request $request){
        try {
            $credentials = $request->validate([
                'email' => 'required|string|email|max:50',
                'password' => 'required|string|min:3'
            ]);
            
            $user = User::where('email', $request->input('email'))->first();

            if (!$user || !Hash::check($request->input('password'), $user->password)) {
                return response()->json(['status' => 'failed', 'message' => 'Invalid User']);
            }

            if(Auth::attempt($credentials)){            
                $user = Auth::user();
                $token = $user->createToken('authToken')->plainTextToken;
                session()->put('access_token', 'Bearer '.$token);
                return redirect()->intended('/admin');
            }

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
        return redirect()->intended('/login');
    }
}
