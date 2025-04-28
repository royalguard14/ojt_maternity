<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Profile;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
public function index()
{
    // Get the ID of the currently logged-in user
    $loggedInUserId = Auth::id();

    // Fetch users excluding the currently logged-in user
    $users = User::with('role', 'profile')->where('id', '!=', $loggedInUserId)->get();

    // Fetch all roles
    $roles = Role::all();


     // Assuming there's a setting called 'email'
    $emailDomain = Setting::where('function_desc', 'Email')->value('function') ?? '@zear.com';



    // Return the view with users and roles
    return view('users.index', compact('users', 'roles','emailDomain'));
}


    public function store(Request $request)
    {

    // Get the domain from settings
    $emailDomain = Setting::where('function_desc', 'Email')->value('function') ?? '@zear.com';

    // Combine the input email (username part) with domain
    $fullEmail = $request->email . $emailDomain;

    // Replace email in request data before validation
    $request->merge(['email' => $fullEmail]);


        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);


        return redirect()->route('users.index')->with([
            'success' => 'User created successfully',
            'icon' => 'success'
        ]);
    }

    public function update(Request $request, User $user)
    {

            // Get domain from settings or use default
    $emailDomain = Setting::where('function_desc', 'Email')->value('function') ?? '@zear.com';

    // Append the domain to the input
    $request->merge([
        'email' => $request->email . $emailDomain
    ]);


        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'isActive' => $request->has('isActive'),
        ]);

        return redirect()->route('users.index')->with([
            'success' => 'User updated successfully',
            'icon' => 'success'
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with([
            'success' => 'User deleted successfully',
            'icon' => 'success'
        ]);
    }
}