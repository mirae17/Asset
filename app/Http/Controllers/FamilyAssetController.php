<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Asset;
use App\Helpers\FaraidCalculator;
use App\Models\Family;
use App\Models\User;

class FamilyAssetController extends Controller
{
    public function index()
    {
    


        if (Auth::check()) {
            // Get the authenticated user
            $user = Auth::user();

            // Retrieve the corresponding Family record for the logged-in user
            $loggedInFamily = Family::where('id', $user->id)->first();

            if ($loggedInFamily) {
                // Get the assigned_by_user_id of the logged-in family
                $assignedByUserId = $loggedInFamily->assigned_by_user_id;

                // Retrieve all family members with the same assigned_by_user_id
                $familyMembers = Family::where('assigned_by_user_id', $assignedByUserId)->get();
                $assets = Asset::where('user_id', $assignedByUserId)->get();
                $calculator = new FaraidCalculator();
                $shares = $calculator->calculate($assets,  $familyMembers);

                // Return the view with the logged-in family and other family members
                return view('familyAsset.index', compact('loggedInFamily', 'familyMembers','assets','shares'));
            } else {
                // Handle the case where the Family record is not found
                return redirect()->route('login')->with('error', 'Family member not found.');
            }
        } else {
            // Handle the case where no user is authenticated
            return redirect()->route('login')->with('error', 'You need to log in first.');
        }
    }
    
    }

