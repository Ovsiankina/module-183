<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tokens\CreateTokenRequest;
use App\Http\Requests\Tokens\UpdateTokenRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

// Généré avec la commande : php artisan make:controller TokensController --api
class TokensController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $tokens = $request->user()->tokens()->get();
        return response()->json($tokens);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTokenRequest $request): JsonResponse
    {
        $tokenData = $request->validated();
        $token = $request->user()->createToken($tokenData["name"], $tokenData["abilities"]);
        return response()->json($token, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, PersonalAccessToken $token): JsonResponse
    {
        return response()->json($token);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTokenRequest $request, PersonalAccessToken $token): JsonResponse
    {
        $token->update($request->validated());
        return response()->json($token);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PersonalAccessToken $token): JsonResponse
    {
        $token->delete();
        return response()->json(null, 204);
    }
}
