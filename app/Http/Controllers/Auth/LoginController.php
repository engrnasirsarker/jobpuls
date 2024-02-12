<?php
namespace App\Http\Controllers\Auth;

use Laravel\Fortify\FortifiesLoginRequests;
use Illuminate\Http\Request;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

class LoginController extends AuthenticatedSessionController {
    

    protected function authenticated($user) {
        $token = $user->createToken('api-token')->accessToken;

        return response()->json(['token' => $token]);
    }
}
