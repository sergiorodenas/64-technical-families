<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class JsonFormRequest extends FormRequest
{
    public function wantsJson()
    {
        return true;
    }
}
