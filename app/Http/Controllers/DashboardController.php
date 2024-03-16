<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPost;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboardData()
    {
        $user = User::all();
        $totalCompanies = $user->where('user_type', 'employer')->count('id');
        $totalJobPost = JobPost::count('id');
        return response()->json([
            'totalCompanies' => $totalCompanies,
            'totalJobPost' => $totalJobPost,
        ]);
    }
}
