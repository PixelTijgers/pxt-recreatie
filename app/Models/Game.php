<?php

// Model Namespacing.
namespace App\Models;

// Facades.
use Illuminate\Database\Eloquent\Model;

// Traits.
use Spatie\Permission\Traits\HasRoles;

class Game extends Model
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
        //return static::addGlobalScope(new SeasonScope);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'season_id',
        'team_home_id',
        'team_away_id',
        'referee_id',
        'field',
        'game_date'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'season_id' => 'integer',
        'team_home_id' => 'integer',
        'team_away_id' => 'integer',
        'referee_id' => 'integer',
        'field' => 'integer',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'game_date',
        'created_at',
        'updated_at',
    ];

    /**
     * Model relations.
     *
     */
    public function teamHome()
    {
        return $this->belongsTo(\App\Models\Team::class, 'team_home_id');
    }

    public function teamAway()
    {
        return $this->belongsTo(\App\Models\Team::class, 'team_away_id');
    }

    public function referee()
    {
        return $this->belongsTo(\App\Models\Team::class, 'referee_id');
    }
}
