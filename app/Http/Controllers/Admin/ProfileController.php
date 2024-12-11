<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function profileIndex()
    {
        $user = auth()->user();
        return view("profile.profile",compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        // Validate the request input
        $request->validate([
            'name' => 'required',
            'telephone1' => 'required',
            'address1' => 'required',
            'city_town' => 'required',
            'country' => 'required',
            'postcode' => 'required',
        ]);

        // Get the current authenticated user (admin)
        $user = auth()->user();

        // Update the user profile with the request data
        $user->update([
            'name' => $request->input('name'),
            'telephone1' => $request->input('telephone1'),
            'address1' => $request->input('address1'),
            'city_town' => $request->input('city_town'),
            'country' => $request->input('country'),
            'postcode' => $request->input('postcode'),
        ]);

        // Redirect back with success message
         if ($user) {
            Session::flash('message', 'User Profile Updated successfully!');
            Session::flash('alert-class', 'alert-success');
            return redirect()->back();
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
        }
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'], // Adjust max file size as per your requirement
        ]);

        $user = auth()->user();

        if ($request->file('avatar')) {
            $avatar = $request->file('avatar');
            $timestamp = time();
            $randomNumbers = mt_rand(1000, 9999); // Generate random number between 1000 and 9999
            $avatarName = $timestamp . '-' . $randomNumbers . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/build/users/');
            $avatar->move($avatarPath, $avatarName);
            $user->avatar =  $avatarName;
        }

        $user->update();
        if ($user) {
            Session::flash('message', 'User Profile photo Updated successfully!');
            Session::flash('alert-class', 'alert-success');
            return redirect()->back();
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
        }
    }

    public function change_password(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string',  'confirmed'],
        ]);
        // dd($request);
        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            Session::flash('message', 'Your Current password does not matches with the password you provided. Please try again.!');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        } else {
            $id = Auth::user()->id;
            $user = User::find($id);
            $user->password = Hash::make($request->get('password'));
            $user->update();
            if ($user) {
                Session::flash('message', 'Password updated successfully!');
                Session::flash('alert-class', 'alert-success');
                return redirect()->back();
            } else {
                Session::flash('message', 'Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
            }
        }
    }
}
