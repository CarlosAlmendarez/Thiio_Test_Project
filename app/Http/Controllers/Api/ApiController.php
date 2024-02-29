<?php

namespace App\Http\Controllers\Api;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    // User Register (POST, formdata)
    public function register(Request $request){
        
        // data validation
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed"
        ]);

        // User Model
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        $token = JWTAuth::attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);

        if(!empty($token)){

            return response()->json([
                "status" => true,
                "message" => "User registered successfully",
                "token" => $token
            ],200);
        }else{
            return response()->json([
                "status" => true,
                "message" => "User can't be register",
            ],302);
        }
}

    public function login(Request $request){
        
        // data validation
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        // JWTAuth
        $token = JWTAuth::attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);

        if(!empty($token)){

            return response()->json([
                "status" => true,
                "message" => "User logged in succcessfully",
                "token" => $token
            ],200);
        }

        return response()->json([
            "status" => false,
            "message" => "Invalid details"
        ],302);
    }

    // User Profile (GET)
    public function profile(){

        $userdata = auth()->user();

        return response()->json([
            "status" => true,
            "message" => "Profile data",
            "data" => $userdata
        ],200);
    } 

    // To generate refresh token value
    public function refreshToken(){
        
        $newToken = auth()->refresh();

        return response()->json([
            "status" => true,
            "message" => "New access token",
            "token" => $newToken
        ],200);
    }

    // User Logout (GET)
    public function logout(){
        
        auth()->logout();

        return response()->json([
            "status" => true,
            "message" => "User logged out successfully"
        ],200);
    }

    public function deleteUser(Request $request){
        $user = User::findOrFail($request->id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();
    
        return response()->json(['message' => 'User successfully deleted'],200);
    }

    public function update(Request $request){

        $user = User::findOrFail($request->id);

        if($request->email === null && $request->name === null && $request->password === null){
            return response()->json(['message' => "User information can't be empty"], 400);
        }

        if($request->email && $request->email != $user->email){
            $request->validate([
                "email" => "required|email|unique:users"
            ]);
        }
        if($request->password){
            $request->validate([
                "password" => "required|confirmed"
            ]);
        }
        // Fill user model
        $user->fill([
            "name" => ($request->name) ? ($request->name) : ($user->name),
            "email" => ($request->email) ? ($request->email) : ($user->email),
            "password" => ($request->password) ? ($request->password) : ($user->password)
        ]);

        // Save user to database
        $user->save();


        return response()->json([
            "status" => true,
            "message" => "User updated successfully"
        ],200);
    }

}
