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

        $validator  =Validator::make($request->all(),$user->rules);
        if ($validator ->fails()) {
            return response()->json([
                'request' => $validator->errors(),
                'messsage' => 'Register Failed...',
            ]);
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
            'request' => $request->all(),
            'messsage' => 'Register Succesfully...',
        ]);
    }
    /**
     * function update user
     */
    public function update(User $user, Request $request)
    {
        $validator  =Validator::make($request->all(),$user->rules);
        if ($validator ->fails()) {
            return response()->json([
                'request' => $validator->errors(),
                'messsage' => 'Register Failed...',
            ]);
        }

        $data =  $request->all();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::Make($data['password']);
        $user->save();

        return response()->json([
            'request' => $request->all(),
            'messsage' => 'Updated Succesfully...',
        ]);
    }
}
