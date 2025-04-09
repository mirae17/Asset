<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Family;
use App\Models\User;
class FamilymemberdetailsController extends Controller
{
    public function index()
    {
        $family = User::where('userType', 'family')->get();
        $family = Family::all();
        // dd( $asset);
        return view('family.index',compact('family'));
    }

 
    public function show(Family $family)
    {
        return view('family.show',compact('family'));
    }

  
}
