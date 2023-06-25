<?php

namespace App\Http\Controllers;
use App\Models\User;
use Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use DataTables;

class HomeController extends Controller
{
    public function index()
    {

            // Pass the QR code to the view
            return view('auth.dashboard');
        }

        public function users(Request $request)
        {
            $users = User::all();
            return view('auth.user')->with('users' , $users);
        }


    public function profile(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::where('id' , $id)->first();
        return view('auth.profile')->with('user' , $user);

    }

    public function update(Request $request)
    {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users,email,' . auth()->user()->id,
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = auth()->user();
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            if ($request->hasFile('image')) {
                $profileImage = $request->file('image');
                $profileImagePath = $profileImage->store('image', 'public');
                if ($user->profile_image) {
                    Storage::disk('public')->delete($user->profile_image);
                }
                $user->image = $profileImagePath;
            }
            $user->save();

            return redirect()->back()->with('success', 'Profile updated successfully.');


    }



}
