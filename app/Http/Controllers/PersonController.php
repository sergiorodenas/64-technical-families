<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonRequest;
use App\Models\Person;
use Illuminate\Http\Response;

class PersonController extends Controller
{
    public function List(): Response
    {
        //
    }

    public function Get(Person $person): Response
    {
        //
    }

    public function Create(PersonRequest $request): Response
    {
        //
    }

    public function Update(PersonRequest $request, Person $person): Response
    {
        //
    }

    public function Delete(PersonRequest $request, Person $person): Response
    {
        //
    }
}
