<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        $valid = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => "required|min:8"
        ]);

        if($valid->fails()){
            return response()->json([
                'message' => $valid->errors()
            ]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        $apiToken = $user->createToken('bearer Token')->plainTextToken;
        return response()->json([
            'message' => "User Created successfully",
            "token" => $apiToken
        ]);

    }

    public function login(Request $request){
        $valid = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => "required|min:8"
        ]);

        if($valid->fails()){
            return response()->json([
                'message' => $valid->errors()
            ]);
        }

        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => "Email or Password Wrong"
            ]);
        }


        $apiToken = User::where('email',$request->email)->first()->createToken('bearer token')->plainTextToken;

        return response()->json([
            'message' => "User Login successfully",
            "token" => $apiToken
        ]);
    }

    public function logout(){
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => "User logout successfully Pr"
        ]);
    }

}
