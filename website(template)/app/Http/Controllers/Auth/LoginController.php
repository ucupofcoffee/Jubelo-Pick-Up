<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'title' => 'Login',
        ]);
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:8|max:255',
        ]);

        $validator = validator($request->only('email', 'password'), [
            'email' => 'required|email:rfc,dns',
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages([
                'email' => $validator->errors()->first('email'),
            ]);
        }

        $validator = validator($request->only('email', 'password'), [
            'password' => 'required|min:8|max:255',
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages([
                'password' => $validator->errors()->first('password'),
            ]);
        }

        if ($validator) {
            if (Auth::attempt($request->only('email', 'password'))) {
                return redirect()->route('dashboard.index');
            } else {
                throw ValidationException::withMessages([
                    'email' => 'Invalid email or password',
                ]);
            }
        }
    }
    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
