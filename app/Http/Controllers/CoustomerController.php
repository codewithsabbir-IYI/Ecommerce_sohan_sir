<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CoustomerController extends Controller
{
    public function coustomer(){
        return view('frontend.coustomer.login');
    }
    public function coustomer_register (Request $request){

        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => bcrypt($request->password),
            'role' => 'customer',
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
    public function coustomer_dashboard(){
        return view('frontend.coustomer.dashboard');
    }


}
