<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Hash; 

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('userType', 'user')->get();

        return view('user.index',compact('users'));
       
    }

    public function create()
    {

        return view('user.create');

    }
   public function store(Request $request)
   {
        $request->validate([
            'name'=> 'required',
            'email'=> 'required',
            'phone_number'=> 'required',
            'address'=> 'required',
            'userType'=> 'required',
            'password'=> 'required',
        ]);

        // DB::table('users')->insert([
        //     'name' => $request->name,
        //     'password' => $request->password,
        //     'email' => $request->email,
        // ]);

         User::create($request->all());

        return redirect()->route('user.index')
                        ->with('success','User created successfully.');
   }

   public function show(User $users)
   {
        return view('user.show',compact('users'));
   }

   public function edit(User $users)
    {
        return view('user.edit',compact('users'));
    }

    public function update(Request $request, User $user)
    {
        // $request->validate([
        //     'name'=> 'required',
        //     'email'=> 'required',
        //     'phone_number'=> 'required',
        //     'address'=> 'required',
        //     'password'=> 'required',
        // ]);

        DB::table('users')->where('id',$request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
  
         $users->update($request->all());
  
        return redirect()->route('user.index')
                        ->with('success','User updated successfully');
    }

    
    public function destroy(User $users)
    {
        $users->delete();
  
        return redirect()->route('user.index')
                        ->with('success','User deleted successfully');
    }

    
   

    
}
