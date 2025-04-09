<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Asset;
use App\Models\Family;

class UserHomeController extends Controller
{
    public function index()
    {
        return view('userAsset.home');
    }

    public function dashboard()
    {
        $userId = Auth::id();
        
        // Count assets created by the logged-in user
        $assetCount = Asset::where('user_id', $userId)->count();
        
        // Count family members created by the logged-in user
        $familyCount = Family::where('assigned_by_user_id', $userId)->count();
        
        return view('userD.dashboard', compact('assetCount', 'familyCount'));
    }
}
