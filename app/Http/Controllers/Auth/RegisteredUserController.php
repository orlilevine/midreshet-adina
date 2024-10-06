<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'street_address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'zip_code' => ['nullable', 'string', 'max:10'],
            'country' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],
            'date_of_birth' => ['required', 'date'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Set the default role_id (adjust this based on your role setup)
        $defaultRoleId = Role::where('name', 'user')->first()->id ?? 1; // Fallback to ID 1 if not found

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'country' => $request->country,
            'phone_number' => $request->phone_number,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $defaultRoleId,
        ]);

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
