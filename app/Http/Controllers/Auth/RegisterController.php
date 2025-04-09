<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:11'], // Maximum length set to 11 characters
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'userType' => ['required', 'string', 'in:head,admin,user,family'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'address' => $data['address'],
            'userType' => 'user',
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function redirectTo()
    {
        $userType = auth()->user()->userType;

        switch ($userType) {
            case 'head':
                return '/headAsset/home';
            case 'admin':
                return '/home';
            case 'user':
                return '/userAsset/home';
            case 'family':
                return '/familyAsset/home';
            default:
                return RouteServiceProvider::HOME;
        }
    }
}
