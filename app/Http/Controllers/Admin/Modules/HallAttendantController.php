<?php

// Controller namespacing.
namespace App\Http\Controllers\Admin\Modules;
use App\Http\Controllers\Controller;

// Facades.
use Yajra\Datatables\Datatables;
use Yajra\DataTables\Html\Builder;

// Models.
use App\Models\HallAttendant;
use App\Models\Season;

// Request
use App\Http\Requests\HallAttendantRequest;

// Traits
use App\Traits\DataTableActionsTrait;
use App\Traits\HasRightsTrait;

// Carbon
use Carbon\Carbon;

class HallAttendantController extends Controller
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
        // Init datatables.
        if (request()->ajax()) {
            return DataTables::of(HallAttendant::query()->with(['team', 'game']))
            ->editColumn('game.game_date', function(HallAttendant $hall_attendant) {
                return Carbon::parse($hall_attendant->game_date)->formatLocalized('%d-%m-%Y om %H:%M');
            })
            ->addColumn('action', function (HallAttendant $hall_attendant) {
                return
                    '<div class="d-flex">' .
                        $this->setAction('hallattendant.index', $hall_attendant, 'view', 'hall-attendants', false) .
                        $this->setAction('hallattendant.edit', $hall_attendant, 'update', 'hall-attendants') .
                        $this->setAction('hallattendant.destroy', $hall_attendant, 'destroy', 'hall-attendants') .
                    '</div>';
            })
            ->make(true);
        }

        // Set values.
        $html = $builder
                    ->addColumn([
                        'title' => __('Hall Moniter'),
                        'data' => 'team.name'
                    ])
                    ->addColumn([
                        'title' => 'Datum wedstrijd',
                        'data' => 'game.game_date'
                    ])
                    ->addAction([
                        'title' => __('Actions'),
                        'class' => 'actionHandler'
                    ])
                    ->parameters([
                        'order' =>
                            [0,'asc']
                    ]);

        // Init view.
        return view('admin.modules.hall-attendant.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Init view.
        return view('admin.modules.hall-attendant.createEdit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HallAttendantRequest $request)
    {
        // Get the selected season.
        $getSeason = Season::where('year', session()->get('season'))->first();

        // Post data to database.
        HallAttendant::Create([
            'season_id' => $getSeason->id
        ] + $request->validated());

        // Return back with message.
        return redirect()->route('hallAttendant.index')->with([
                'type' => 'success',
                'message' => __('Alert Add')
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HallAttendant  $hall_attendant
     * @return \Illuminate\Http\Response
     */
    public function edit(HallAttendant $hall_attendant)
    {
        // Init view.
        return view('admin.modules.hall-attendant.createEdit', compact('hall_attendant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HallAttendant  $hall_attendant
     * @return \Illuminate\Http\Response
     */
    public function update(HallAttendantRequest $request, HallAttendant $hall_attendant)
    {
        // Set data to save into database.
        $hall_attendant->update($request->validated());

        // Save data.
        $hall_attendant->save();

        // Return back with message.
        return redirect()->route('hallAttendant.index')->with([
                'type' => 'success',
                'message' => __('Alert Edit')
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $hall_attendant
     * @return \Illuminate\Http\Response
     */
    public function destroy(HallAttendant $hall_attendant)
    {
        // Delete the model.
        $hall_attendant->delete();

        // Return back with message.
        return redirect()->back()->with([
            'type' => 'success',
            'message' => __('Alert Delete')
        ]);
    }
}
