<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('adminProfile.show', compact('user'));
    }
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone_number' => ['required', 'string', 'regex:/^[0-9]{10,11}$/'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
      
            if ($user->avatar) {
                unlink(public_path('profile_images/admin' . $user->avatar));
            }

            $avatarPath = time().'.'.$request-> avatar->extension();
            $request->avatar->move(public_path('profile_images/admin'),  $avatarPath);

            $avatarPath = $request->file('avatar')->store('profile_images', 'public');
            $user->avatar = $avatarPath;

            $user->update([
                'user_image' => $UserImage,
            ]);
        }


        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
