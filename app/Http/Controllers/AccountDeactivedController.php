<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AccountDeactivedController extends Controller
{
    public function index()
    {
        $users = User::where('status', 'deactivated')
        ->where('userType', 'user')
        ->get();

        return view('accountDeactived.index', compact('users'));
       
    }
}
