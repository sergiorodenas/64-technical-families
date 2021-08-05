<?php

namespace App\Http\Controllers;

use App\Http\Requests\FamilyRequest;
use App\Models\Family;
use App\Models\Person;
use Illuminate\Http\JsonResponse;

class FamilyController extends Controller
{
    public function Create(FamilyRequest $request): JsonResponse
    {
        $family = Family::createFromRequest($request);

        return response()->json($family, 201);
    }

    public function AddMember(FamilyRequest $request, Family $family, Person $person): JsonResponse
    {
        // Idempotent
        $family->members()->syncWithoutDetaching([$person->id]);

        return response()->json('Person added to family successfully', 200);
    }
}
