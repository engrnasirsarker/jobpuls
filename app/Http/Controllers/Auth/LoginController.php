<?php
namespace App\Http\Controllers\Auth;

use Laravel\Fortify\FortifiesLoginRequests;
use Illuminate\Http\Request;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use App\Models\User;
use Exception;
use Hash;
use Auth;

class LoginController extends AuthenticatedSessionController {
    

    protected function authenticated($user) {
        $token = $user->createToken('api-token')->accessToken;

        return response()->json(['token' => $token]);
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
                return response()->json(['status' => 'success', 'message' => 'Login success']);
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
                return response()->json(['status' => 'success', 'message' => 'Login success']);
                
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Invalid credentials']);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
