<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * function register user
     */
    public function register(Request $request)
    {
        $user = new User();

        $validator  =Validator::make($request->all(),$user->rules, $user->messages);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'messsage' => 'Register Failed...',
            ], 400);
        }

        $data =  $request->all();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::Make($data['password']);
        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data' => $request->all(),
            'messsage' => 'Register Succesfully...',
        ], 201);
    }
    /**
     * function update user
     */
    public function update(User $user, Request $request)
    {
        $validator  =Validator::make($request->all(),$user->rules, $user->messages);
        if ($validator ->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'messsage' => 'Updated Failed...',
            ], 400);
        }

        $data =  $request->all();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::Make($data['password']);
        $user->save();

        return response()->json([
            'data' => $request->all(),
            'messsage' => 'Updated Succesfully...',
        ], 200);
    }
}
