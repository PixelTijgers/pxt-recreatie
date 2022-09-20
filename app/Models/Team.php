<?php

// Model Namespacing.
namespace App\Models;

// Facades.
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Traits.
use Spatie\Permission\Traits\HasRoles;

// Scopes.
use App\Scopes\SeasonScope;

class Team extends Model
{
    /**
     * Traits
     *
     */
    use HasRoles;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        return static::addGlobalScope(new SeasonScope);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'season_id',
        'name',
    ];

    /**
     * Model relations.
     *
     */
    public function season()
    {
        return $this->belongsTo(\App\Models\Season::class);
    }
}
