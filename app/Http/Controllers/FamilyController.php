<?php

namespace App\Http\Controllers;

use App\Http\Requests\FamilyRequest;
use App\Models\Family;
use App\Models\Person;
use Illuminate\Http\Response;

class FamilyController extends Controller
{
    public function Create(FamilyRequest $request): Response
    {
        //
    }

    public function AddMember(FamilyRequest $request, Family $family, Person $person): Response
    {
        //
    }
}
