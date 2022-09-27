<?php

// Model Namespacing.
namespace App\Models;

// Facades.
use Illuminate\Database\Eloquent\Model;

// Traits.

class Result extends Model
{
    /**
     * Traits
     *
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'game_id',
        'team_home_id',
        'team_away_id',
        'team_home_score',
        'team_away_score',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'game_id' => 'integer',
        'team_home_id' => 'integer',
        'team_away_id' => 'integer',
        'team_home_score' => 'integer',
        'team_away_score' => 'integer',
    ];
}
