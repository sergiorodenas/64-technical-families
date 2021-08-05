<?php

namespace App\Models;

use App\Events\PersonCreated;
use App\Http\Requests\PersonRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Person extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $dates = ['created_at', 'updated_at'];

    /* ********************* MODIFICATIONS ************************** */

    protected $dispatchesEvents = [
        'created' => PersonCreated::class
    ];

    /* ********************* RELATIONS ************************** */

    public function families(): BelongsToMany
    {
        return $this->belongsToMany(Family::class);
    }

    /* ********************* CRUD ************************** */

    public static function createFromRequest(PersonRequest $request): self
    {
        return self::create([
            'name' => $request->get('name')
        ]);
    }
}
