<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class DashboardController extends Controller
{
    public function dashboard()
    {
        $activeUsersCount = User::where('userType', 'user')
        ->whereNotIn('status', ['deactivated', 'rejected'])->count();
        $inactiveUsersCount = User::where('userType', 'user')
        ->where('status', 'deactivated')->count();
    
        return view('adminD.dashboard', compact('activeUsersCount', 'inactiveUsersCount'));
    }
}
