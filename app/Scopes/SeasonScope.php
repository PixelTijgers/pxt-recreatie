<?php

// Namespacing.
namespace App\Scopes;

// Facades/
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SeasonScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $getSeason = \App\Models\Season::where('year', session()->get('season'))->first();

        if (!\Route::currentRouteNamed('game.*')) {
            $builder->where('season_id', $getSeason->id);
        }
    }
}
