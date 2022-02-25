<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function profile()
    {
        return view('profile.index');
    }
    public function change_name(Request $request)
    {

        User::find(auth()->id())->update([
            'name' => $request->new_name,
            'phone_number' => $request->phone_number
        ]);

        if ($request->hasFile('profile_photo')) {
            $new_name = auth()->id().".".$request->file('profile_photo')->getClientOriginalExtension();
            Image::make($request->file('profile_photo'))->resize(196,196)->save(base_path('public/dashboard/uploads/profile_photo/'.$new_name));
            User::find(auth()->id())->update([
                'profile_photo' => $new_name
            ]);
        }
        return back()->with('name_changed', 'Changed Successfully');

    }
    public function change_password(Request $request)
    {

        if (Hash::check($request->current_password, auth()->user()->password)) {
            if ($request->new_password != $request->confirm_password) {
                return back()->with('pass_and_conpass_not_match', 'Password And Confirm Password Not Match');
            }
            else{
                User::find(auth()->id())->update([
                    'password' => bcrypt($request->new_password)
                ]);
                return back()->with('password_changed', 'Password Changed Successfully');

            }
        }
        else{
            return back()->with('current_password_not_match', 'Current Password is not matching with us');
        }

    }
}
