<?php

namespace App\Models;

use App\Http\Requests\FamilyRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Family extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $dates = ['created_at', 'updated_at'];

    /* ********************* RELATIONS ************************** */

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }

    /* ********************* CRUD ************************** */

    public static function createFromRequest(FamilyRequest $request): self
    {
        return self::create([
            'name' => $request->get('name')
        ]);
    }
}
