<?php

namespace App\Http\Controllers;

use App\Http\Requests\Kids\ListKidRequest;
use App\Http\Requests\Kids\ReadKidRequest;
use App\Http\Requests\Kids\StoreKidRequest;
use App\Http\Requests\Kids\UpdateKidsRequest;
use App\Http\Requests\Kids\WriteKidRequest;
use App\Models\Kid;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class KidsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ListKidRequest $request): JsonResponse
    {
        $request->validated();
        $kids = Kid::all("id", "name", "birthDate", "wiseLevel");
        return response()->json($kids);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKidRequest $request): JsonResponse
    {
        $kid = Kid::create($request->validated());
        return response()->json($kid, 201); // NOTE(ex 2): Ajout du code 201
    }

    /**
     * Display the specified resource.
     */
    // NOTE(ex 5): filter out kids that aren't `WISE_LEVEL_4` when the only
    // ability is set to `kids:read:unwise`
    public function show(ReadKidRequest $request, Kid $kid): JsonResponse
    {
        $user = $request->user();

        $canAll = $user->tokenCan('*') || $user->tokenCan('kids:list');
        $canUnwise = $user->tokenCan('kids:read:unwise');

        if (! $canAll && ! $canUnwise) {
            return response()->json([
                'message' => 'Permission denied.',
            ], 403);
        }

        if (! $canAll && $canUnwise) {
            if ($kid->wiseLevel !== Kid::WISE_LEVEL_4) {
                return response()->json([
                    'message' => 'Permission denied for this kid.',
                ], 403);
            }
        }

        return response()->json($kid);
    }

    /**
     * Update the specified resource in storage.
     */
    // NOTE(ex 3): Type `Request` changé en `UpdateKidsRequest`
    // public function update(Request $request, Kid $kid): JsonResponse
    public function update(UpdateKidsRequest $request, Kid $kid): JsonResponse
    {
        $kid->update($request->validated());
        return response()->json($kid);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WriteKidRequest $request, Kid $kid): JsonResponse
    {
        $kid->delete();
        return response()->json(null, 204);
    }
}
