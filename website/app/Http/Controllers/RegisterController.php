<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:admins,name',
            'email' => 'required|email:rfc,dns|unique:admins,email',
            'password' => 'required|min:8|max:255',
        ]);

        $name = ucwords(strtolower($request->name));

        Admin::create([
            'name' => $name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Admin account created successfully');
    }
}
