<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Family;
use App\Models\User;

class UserFamilyController extends Controller
{
    public function index()
    {
        if(Auth::check()) {
            $user = Auth::user();
            // Retrieve family members assigned by the authenticated user
            $family = Family::where('assigned_by_user_id', $user->id)->get();
            return view('userFamily.index', compact('family'));
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
        return view('userFamily.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'type' => 'required',
            // 'address' => 'required',
            // 'date' => 'required',

            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone_number' => 'required',
            'address' => 'required',
            'relation' => 'required',
            'password' => 'required|min:8',
           
        ]);

      

        $users = new User();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->phone_number = $request->phone_number;
        $users->address = $request->address;
        $users->userType= 'family';
        $users->status = false;
        $users->password = bcrypt($request->password); // Encrypt password
        $users->save();

        $family = new Family();
        $family->id = $users->id; // Set the Family ID to match the User ID
        $family->name = $request->name;
        $family->email = $request->email;
        $family->phone_number = $request->phone_number;
        $family->address = $request->address;
        $family->relation = $request->relation;
        $family->password = bcrypt($request->password); // Encrypt password
        $family->assigned_by_user_id = Auth::id(); // Assign the current user's ID
        $family->save();
    
        // User::create($request->all());

        // return redirect()->route('userFamily.index')
        //                 ->with('success','Family member created successfully.');


        return redirect()->route('userFamily.index')->with('success', 'Family member request submitted.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Family $family)
    {
        return view('userFamily.show',compact('family'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Family $family)
    {
        
        return view('userFamily.edit',compact('family'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Family $family)
{
    // Retrieve the corresponding User model
    $user = User::where('email', $family->email)->first();

    // Validate the request
    $request->validate([
        'name' => 'required',
        'email' => [
            'required',
            Rule::unique('users')->ignore($user->id), // Ignore the current user's email
        ],
        'phone_number' => 'required',
        'address' => 'required',
        'relation' => 'required',
        'password' => 'required|min:8',
    ]);

    // Update the User model
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone_number = $request->phone_number;
    $user->address = $request->address;
    $user->password = bcrypt($request->password); // Encrypt password
    $user->save();

    // Update the Family model
    $family->name = $request->name;
    $family->email = $request->email;
    $family->phone_number = $request->phone_number;
    $family->address = $request->address;
    $family->relation = $request->relation;
    $family->password = bcrypt($request->password); // Encrypt password
    $family->assigned_by_user_id = Auth::id();
    $family->save();

    return redirect()->route('userFamily.index')
                    ->with('success', 'Family Members updated successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Family $family)
{
    // Find the corresponding User model by email
    $user = User::where('email', $family->email)->first();

    // Delete both the Family and User models
    $family->delete();
    $user->delete();

    return redirect()->route('userFamily.index')
                    ->with('success','Family Member deleted successfully');
}


    public function request(Request $request)
{
    // Retrieve the authenticated user
    $users = auth()->user();

    // Update the user's request status to "pending" or "submitted"
    $users->status = 'pending'; // You can change this to 'submitted' if needed
    $users->save();

    // Redirect back with a success message or do whatever is necessary
    return redirect()->back()->with('success', 'Your request is pending approval.');
}

public function table()
    {
        $user = Auth::user();
        // Retrieve family members assigned by the authenticated user
        $family = Family::where('assigned_by_user_id', $user->id)->get();
        
        // Return the view with the fetched data
        return view('userFamily.table', compact('family'));
    }
}
