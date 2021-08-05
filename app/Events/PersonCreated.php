<?php

namespace App\Events;

use App\Models\Person;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PersonCreated
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Person $person
    ){}
}
