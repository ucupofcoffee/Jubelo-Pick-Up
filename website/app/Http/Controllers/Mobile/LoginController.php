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
    
        $driver = Driver::where('email', $request->email)->first();
    
        if (!$driver || !Hash::check($request->password, $driver->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        if ($driver->status !== 'Active') {
            return response()->json(['error' => 'Driver is not active'], 403);
        }
    
        $token = $driver->createToken('authToken')->plainTextToken;
    
        return response()->json(['token' => $token], 200);
    }
    
    public function logout(Request $request)
    {
        $driver = Auth::guard('api')->user();

        if (!$driver) {
            return response()->json([
                'message' => 'Driver not authenticated',
            ], 401);
        }

        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out'], 200);
    }
}
