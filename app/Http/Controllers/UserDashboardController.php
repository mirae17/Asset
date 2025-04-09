<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Family;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();
        
        // Count assets created by the logged-in user
        $assetCount = Asset::where('user_id', $userId)->count();
        
        // Count family members created by the logged-in user
        $familyCount = Family::where('id', $userId)->count();
        
        return view('userD.dashboard', compact('assetCount', 'familyCount'));
    }
}
