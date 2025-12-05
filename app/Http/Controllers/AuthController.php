<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request): JsonResponse
    {
        if (Auth::once($request->validated())) {
            $token = Auth::user()->createToken("login-token");
            return response()->json(["token" => [
                "token" => $token->plainTextToken,
                "type" => "Bearer",
                "abilities" => ["*"]
            ]]);
        }

        return response()->json(["error" => "Invalid credentials"], 401);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(null, 204);
    }
}
