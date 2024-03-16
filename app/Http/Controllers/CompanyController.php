<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CompanyController extends Controller
{
    function index(){
        $data = User::where('user_type','employer')->get();
        return response()->json($data);
    }
}
