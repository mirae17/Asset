<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AccountActiveController extends Controller
{
    public function index()
    {
        $users = User::where('userType', 'user')
        ->whereNotIn('status', ['deactivated', 'rejected'])
        ->get();


        return view('accountActive.index', compact('users'));
       
    }
}
