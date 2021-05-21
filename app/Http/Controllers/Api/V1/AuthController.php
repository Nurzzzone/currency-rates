<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'Registration passed succefully',
            'access_token' => $token,
            'code' => 201
        ])->setStatusCode(201);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $user = User::where('email', '=', $data['email'])->first();
        if (!Hash::check($data['password'], $user->password) ) {
            return response()->json($this->responseWithError())->setStatusCode(401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json($this->responseWithToken($token))->setStatusCode(200);
    }

    public function logout()
    {
        $user = Auth::user();
        $user->tokens()->delete();
        return response(null, 200);
    }

    protected function responseWithToken($token)
    {
        return [
            'message' => 'Authorization passed succefully',
            'access_token' => $token,
            'code' => 200,
        ];
    }

    protected function responseWithError()
    {
        return [
            'message' => 'Unauthorized',
            'code' => 403,
        ];
    }
}
