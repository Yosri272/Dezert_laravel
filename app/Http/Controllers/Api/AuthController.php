<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Jobs\SendWelcomeEmail;



class AuthController extends Controller
{
    // This method handles the user signup (registration) logic
    public function signup(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',            // Name is required, must be a string
            'email'    => 'required|email|unique:users',        // Email must be valid and unique in users table
            'password' => 'required|min:6',                     // Password must be at least 6 characters
        ]);

        // If validation fails, return error response with 422 status
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create new user record in the database with hashed password
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password), // Always hash passwords!
        ]);

        // Dispatch a job to send the welcome email asynchronously via queue
        dispatch(new SendWelcomeEmail($user));

        // Return success response
        return response()->json(['message' => 'Signup successful!']);
    }
}
