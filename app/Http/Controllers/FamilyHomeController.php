<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FamilyHomeController extends Controller
{
    public function index()
    {
        return view('familyAsset.home');
    }
}
