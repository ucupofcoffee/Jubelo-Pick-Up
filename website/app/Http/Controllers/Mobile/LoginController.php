<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Driver;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:8|max:255',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        $driver = Driver::where('email', $request->email)->first();
    
        if (!$driver || !Hash::check($request->password, $driver->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    
        Auth::login($driver);
    
        $token = $driver->createToken('authToken')->plainTextToken;
    
        return response()->json(['token' => $token], 200);
    }
    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
