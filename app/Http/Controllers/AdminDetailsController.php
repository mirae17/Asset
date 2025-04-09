<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminDetailsController extends Controller
{
    public function index()
    {
        if(Auth::check()) {
            $user = Auth::user();
            // Retrieve admins assigned by the authenticated user
            $admins = User::where('userType', 'admin')
                          ->get();
            return view('adminView.index', compact('admins'));
        } else {
            // Handle the case where no user is authenticated
            return redirect()->route('login')->with('error', 'You need to login first.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminView.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone_number' => 'required',
            'address' => 'required',
            'password' => 'required|min:8',
        ]);

        $admin = new User();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone_number = $request->phone_number;
        $admin->address = $request->address;
        $admin->userType = 'admin';
        $admin->status = false;
        $admin->password = bcrypt($request->password); // Encrypt password
        $admin->save();

        return redirect()->route('adminView.index')->with('success', 'Admin created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $admin)
    {
        if ($admin->userType !== 'admin') {
            abort(404);
        }
        return view('adminView.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $admin)
    {
        if ($admin->userType !== 'admin') {
            abort(404);
        }
        return view('adminView.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $admin)
    {
        if ($admin->userType !== 'admin') {
            abort(404);
        }
    
        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($admin->id),
            ],
            'phone_number' => ['required', 'string', 'regex:/^[0-9]{10,11}$/'],
            'address' => 'required',
            'password' => 'nullable|min:8',
        ]);
    
        // Debug statement to check request data
        // dd($request->all());
    
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone_number = $request->phone_number;
        $admin->address = $request->address;
    
        if ($request->filled('password')) {
            $admin->password = bcrypt($request->password); // Encrypt password
        }
    
        $admin->save();
    
        return redirect()->route('adminView.index')
                         ->with('success', 'Admin updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $admin)
    {
        if ($admin->userType !== 'admin') {
            abort(404);
        }
        
        $admin->delete();
  
        return redirect()->route('adminView.index')
                         ->with('success', 'Admin deleted successfully.');
    }
}
