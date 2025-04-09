<?php

namespace App\Http\Controllers;

use App\Helpers\FaraidCalculator;
use App\Models\Asset;
use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaraidController extends Controller
{
    public function divide()
    {
        $userId = Auth::id();
        
        // Fetch assets and family members assigned to the logged-in user
        $assets = Asset::where('user_id', $userId)->get();
        $family = Family::where('assigned_by_user_id', $userId)->get();
        
        // Calculate shares using FaraidCalculator
        $calculator = new FaraidCalculator();
        $shares = $calculator->calculate($assets, $family);
        
        // Prepare data for view
        $data = [
            'assets' => $assets,
            'family' => $family,
            'shares' => $shares,
        ];
        
        // Return view with data
        return view('faraid.index', $data);
    }
}
