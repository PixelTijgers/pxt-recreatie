<?php

// Controller namespacing.
namespace App\Http\Controllers\Admin\Modules;
use App\Http\Controllers\Controller;

// Facades.
use Yajra\Datatables\Datatables;
use Yajra\DataTables\Html\Builder;

// Models.
use App\Models\Game;
use App\Models\HallAttendant;
use App\Models\Result;
use App\Models\Season;

// Request
use App\Http\Requests\GameRequest;

// Traits
use App\Traits\DataTableActionsTrait;
use App\Traits\HasRightsTrait;

// Carbon
use Carbon\Carbon;

class GameController extends Controller
{
    /**
     * Traits
     *
     */
    use DataTableActionsTrait,
        HasRightsTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder)
    {
        $getSeason = \App\Models\Season::where('year', session()->get('season'))->first();

        // Init datatables.
        if (request()->ajax()) {
            return DataTables::of(Game::query()->with(['teamHome', 'teamAway', 'referee'])->where('season_id', $getSeason->id)->select('games.*'))
            ->editColumn('game_date', function(Game $game) {
                return Carbon::parse($game->game_date)->formatLocalized('%d-%m-%Y om %H:%M');
            })
            ->addColumn('action', function (Game $game) {
                return
                    '<div class="d-flex">' .
                        $this->setAction('game.index', $game, 'view', 'games', false) .
                        $this->setAction('game.edit', $game, 'update', 'games') .
                        $this->setAction('game.destroy', $game, 'destroy', 'games') .
                    '</div>';
            })
            ->make(true);
        }

        // Set values.
        $html = $builder
                    ->addColumn([
                        'title' => __('Home'),
                        'data' => 'team_home.name'
                    ])
                    ->addColumn([
                        'title' => __('Away'),
                        'data' => 'team_away.name'
                    ])
                    ->addColumn([
                        'title' => __('Referee'),
                        'data' => 'referee.name'
                    ])
                    ->addColumn([
                        'title' => __('Field'),
                        'data' => 'field'
                    ])
                    ->addColumn([
                        'title' => __('Gamedate'),
                        'data' => 'game_date'
                    ])
                    ->addAction([
                        'title' => __('Actions'),
                        'class' => 'actionHandler'
                    ])
                    ->parameters([
                        'order' =>
                            [4,'desc'],
                            [3,'asc']
                    ]);

        // Init view.
        return view('admin.modules.game.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Init view.
        return view('admin.modules.game.createEdit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GameRequest $request)
    {
        // Get games.
        $getGames = Game::where('field', $request->field)->where('game_date', $request->game_date)->get();

        // Return to page when field and time are already taken.
        if(!$getGames->isEmpty())
        {
            // Return back with message.
            return redirect()->back()->with([
                'type' => 'danger',
                'message' => 'Er is al een wedstrijd op dit veld met ingepland met deze tijd.'
            ])->withInput();
        }

        // Get the selected season.
        $getSeason = Season::where('year', session()->get('season'))->first();

        // Post data to database.
        $game = Game::create([
            'season_id' => $getSeason->id
        ] + $request->validated());

        if($game->field === 1 && $game->game_date->hour == 20)
        {
            HallAttendant::create([
                'season_id' => $game->season_id,
                'team_id' => $game->team_home_id,
                'game_id' => $game->id,
            ]);
        }

        // Store the scores.
        if(!empty($request->scores->team_home_score) || !empty($request->scores->team_away_score))
            $this->storeScores($game, $request);

        // Return back with message.
        return redirect()->route('game.index')->with([
                'type' => 'success',
                'message' => __('Alert Add')
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        // Init view.
        return view('admin.modules.game.createEdit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(GameRequest $request, Game $game)
    {
        // Get games.
        $getGames = Game::where('field', $request->field)->where('game_date', $request->game_date)->whereNot('id', $game->id)->get();

        // Return to page when field and time are already taken.
        if(!$getGames->isEmpty())
        {
            // Return back with message.
            return redirect()->back()->withInput($request)->with([
                'type' => 'danger',
                'message' => 'Er is al een wedstrijd op dit veld met ingepland met deze tijd.'
            ]);
        }

        // Set data to save into database.
        $game->update($request->validated());

        // Save data.
        $game->save();

        // Input the games.
        $this->storeScores($game, $request);

        // Return back with message.
        return redirect()->route('game.index')->with([
                'type' => 'success',
                'message' => __('Alert Edit')
            ]
        );
    }

    /**
     * Store a the scores in the database.
     *
     * @param  \Illuminate\Http\Request  $game
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function storeScores($game, $request)
    {
        // Delete all the previous sets.
        Result::where('game_id', $game->id)->delete();

        // Add the played sets.
        foreach($request->scores as $scores)
        {
            Result::create([
                'game_id'   =>  $game->id,
                'team_home_id' => $game->team_home_id,
                'team_away_id' => $game->team_away_id,
                'team_home_score' => $scores['team_home_score'],
                'team_away_score' => $scores['team_away_score'],
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        // Delete the model.
        $game->delete();

        // Return back with message.
        return redirect()->back()->with([
            'type' => 'success',
            'message' => __('Alert Delete')
        ]);
    }
}
