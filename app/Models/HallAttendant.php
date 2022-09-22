<?php

// Model Namespacing.
namespace App\Models;

// Facades.
use Illuminate\Database\Eloquent\Model;

// Traits.
use Spatie\Permission\Traits\HasRoles;

class HallAttendant extends Model
{
    /**
     * Traits
     *
     */
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'season_id',
        'game_id',
        'team_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'season_id' => 'integer',
        'game_id' => 'integer',
        'team_id' => 'integer',
    ];

    /**
     * Model relations.
     *
     */
     public function game()
     {
         return $this->belongsTo(\App\Models\Game::class);
     }

     public function team()
     {
         return $this->belongsTo(\App\Models\Team::class);
     }
}
