<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return User::orderBy('id', 'desc')->get();
    }
     /**
     * function login user
     */
    public function login(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'errors' => ['email' => ['The provided credentials are incorrect.']],
                'messsage' => 'Login Failed...',
            ], 400);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data' => $user,
            'messsage' => 'Login Succesfully...',
        ], 200);
    }
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

        $user->name     = $request->input('name');
        $user->email    = $request->input('email');
        $user->telf     = $request->input('telf');
        $user->cpf      = $request->input('cpf');
        $user->fecha_nac= $request->input('fecha_nac');
        $user->password = Hash::Make($request->input('password'));
        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data' => array_merge($request->all(), ['id' => $user->id]),
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

        $user->name     = $request->input('name');
        $user->email    = $request->input('email');
        $user->telf     = $request->input('telf');
        $user->cpf      = $request->input('cpf');
        $user->fecha_nac= $request->input('fecha_nac');
        $user->password = Hash::Make($request->input('password'));
        $user->save();

        return response()->json([
            'data' => $request->all(),
            'messsage' => 'Updated Succesfully...',
        ], 200);
    }
}
