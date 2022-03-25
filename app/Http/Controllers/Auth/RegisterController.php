<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //validate the user 
        $this->validate($request, [
            'name' => 'required|max:255',
            'Username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed', 
         ]);
         
         //store the user 
         User::create([
             'name' => $request->name,
             'email' => $request->email,
             'username' => $request->Username,
             'password' => Hash::make($request->password),
         ]);

        //sign the user in

        //  auth()->attempt([
        //      'email' => $request->email,
        //      'password' => $request->password
        //  ]); 
        auth()->attempt($request->only('email', 'password'));
        //redirect the user

        return redirect()->route('dashboard');
        //sign the user in
    }
}
