<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Family;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        if (auth()->user()->userType === 'admin') {
            return '/home';
        } elseif (auth()->user()->userType === 'user') {
            return '/userAsset/home';
        } elseif (auth()->user()->userType === 'family') {
            return '/familyAsset/home';
        } 

        return RouteServiceProvider::home; // Default redirection
    }

    protected function authenticated(Request $request, $user)
    {
        // Check if the user is deactivated
        if ($user && $user->status === 'deactivated') {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account has been deactivated.');
        }

       
        return redirect()->intended($this->redirectPath());
    }
}
