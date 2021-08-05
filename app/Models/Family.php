<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $dates = ['created_at', 'updated_at'];

    /* ********************* RELATIONS ************************** */

    public function members(){
        return $this->belongsToMany(Person::class);
    }

    /* ********************* CRUD ************************** */

    //CREATE
}
