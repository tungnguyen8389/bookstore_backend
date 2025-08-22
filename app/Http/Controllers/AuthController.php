<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|same:confirmed_password'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('app');
        $input['name'] = $user->name;
        $input['email'] = $user->email;
        $input['token'] = $token->plainTextToken;

        return response()->json([$input]);
    }
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid email or password'], 401);
        }
        $user = Auth::user();
        $token = $user->createToken('app');
        $input['name'] = $user->name;
        $input['email'] = $user->email;
        $input['token'] = $token->plainTextToken;

        return response()->json([$input]);
    }
}
