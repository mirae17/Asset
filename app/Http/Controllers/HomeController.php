<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        $activeUsersCount = User::where('userType', 'user')
        ->whereNotIn('status', ['deactivated', 'rejected'])->count();
        $inactiveUsersCount = User::where('userType', 'user')
        ->where('status', 'deactive')->count();
    
        return view('adminD.dashboard', compact('activeUsersCount', 'inactiveUsersCount'));
    }

   
}
