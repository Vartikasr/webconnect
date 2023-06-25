<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if ($user) {
            return response()->json(false); // Email already exists
        }

        return response()->json(true); // Email is unique
    }


    public function storeRegister(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        // Create a new user
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->save();

        // You can also log in the user here if needed

        return response()->json(['message' => 'Registration successful'], 200);
    }

    public function login()
    {
        return view('auth.login');
    }
    public function checklogin(Request $request)
    {
        $email = $request->input('email');

        $user = User::where('email', $email)->first();

        if ($user) {
            Auth::login($user);
            $redirectUrl = 'dashboard';
            // return response()->json(['redirect_url' => $redirectUrl]);
            return redirect(url('/dashboard'));
        }

        return redirect()->back()->with('error', 'Invalid email');
    }

    public function logout(Request $request)
    {
        session()->flash('message', 'Log Out Now !!');
        Auth::logout();

        return Redirect('login');
    }


}
