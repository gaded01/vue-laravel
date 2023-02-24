<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function loginUser(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        //check if user exists
        $user = User::where('username', $username)->first();
        if (!$user) {
            return response([
                "message" => "Invalid username"
            ], 400);
        }

        //check password
        if (!Hash::check($password, $user->password)) {
            return response(['status' => 'failed', 'message' => 'Incorrect password'], 400);
        }

        //return token and user
        $token = $user->createToken('api_token')->plainTextToken;
        return response([
            'access_token' => $token,
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response(['message' => 'Logged out']);
    }

    public function newUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'gender' => 'required|string',
            'birthdate' => 'required|string',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return [
                "status" => 'failed',
                "data" => $validator->messages(),
            ];
        } else {
        User::create([
            'firstname' =>  $request->firstname,
            'lastname' =>  $request->lastname,
            'gender' =>  $request->gender,
            'birthdate' => Carbon::createFromFormat('Y-m-d', $request->birthdate)->toDateString(),
            'username' =>  $request->username,
            'password' =>  Hash::make($request->password),
 
        ]);
        return response(['message' => "Added successfully"]);
     }
    }

    public function info()
    {
       return Auth::user();
    
    }


    public function getUser($id)
    {
        return User::where('id', $id)->with(['pokemonHate', 'pokemonLike', 'pokemonFavorite'])->first();
    }

    public function getAllUser(Request $request)
    {
        return User::where("id", "!=", $request->user()->id)->get();
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'gender' => 'required|string',
            'birthdate' => 'required|string',
            'username' => 'required',
        ]);

        $user = User::where('id', $request->user()->id)->first();
        if ($request->password) {
            if (!Hash::check($request->password, $user->password)) {
                return User::where('id', $request->user()->id)->update([
                    'firstname' =>  $request->firstname,
                    'lastname' =>  $request->lastname,
                    'gender' =>  $request->gender,
                    'birthdate' => Carbon::createFromFormat('Y-m-d', $request->birthdate)->toDateString(),
                    'username' =>  $request->username,
                    'password' =>  Hash::make($request->password),

                ]);
            }
            else{
                return response()->json(['password' => 'Already Use'], 400);
            }
        }
        return User::where('id', $request->user()->id)->update([
            'firstname' =>  $request->firstname,
            'lastname' =>  $request->lastname,
            'gender' =>  $request->gender,
            'birthdate' => Carbon::createFromFormat('Y-m-d', $request->birthdate)->toDateString(),
            'username' =>  $request->username,
        ]);
        
        return response([
            'status' => 'falied',
            'message' => 'Already Use'
        ]);
    }

    


}
