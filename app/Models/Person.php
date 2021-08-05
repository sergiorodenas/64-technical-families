<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $dates = ['created_at', 'updated_at'];

    /* ********************* RELATIONS ************************** */

    public function families(){
        return $this->belongsToMany(Family::class);
    }

    /* ********************* CRUD ************************** */

    //CREATE
    //UPDATE
}
