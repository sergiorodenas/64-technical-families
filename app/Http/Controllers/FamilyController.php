<?php

namespace App\Http\Controllers;

use App\Http\Requests\FamilyRequest;
use App\Models\Family;
use Illuminate\Http\Response;

class FamilyController extends Controller
{
    public function List(): Response
    {
        //
    }

    public function Get(Family $family): Response
    {
        //
    }

    public function Create(FamilyRequest $request): Response
    {
        //
    }

    public function Update(FamilyRequest $request, Family $family): Response
    {
        //
    }

    public function Delete(FamilyRequest $request, Family $family): Response
    {
        //
    }
}
