<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonRequest;
use App\Models\Person;
use Illuminate\Http\JsonResponse;

class PersonController extends Controller
{
    public function Get(Person $person): JsonResponse
    {
        $person->load('families.members');

        return response()->json($person);
    }

    public function Create(PersonRequest $request): JsonResponse
    {
        $person = Person::createFromRequest($request);

        return response()->json($person, 201);
    }
}
