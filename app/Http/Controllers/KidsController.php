<?php

namespace App\Http\Controllers;

use App\Http\Requests\Kids\ShowKidRequest;
use App\Http\Requests\Kids\StoreKidRequest;
use App\Models\Kid;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KidsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $kids = Kid::all("id", "name", "birthDate", "wiseLevel");
        return response()->json($kids);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKidRequest $request): JsonResponse
    {
        $kid = Kid::create($request->validated());
        return response()->json($kid);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowKidRequest $request, Kid $kid): JsonResponse
    {
        return response()->json($kid);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kid $kid): JsonResponse
    {
        $kid->update($request->all());
        return response()->json($kid);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kid $kid): JsonResponse
    {
        $kid->delete();
        return response()->json(null, 204);
    }
}
