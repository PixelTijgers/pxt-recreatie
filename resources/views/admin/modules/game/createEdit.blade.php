@section('meta')
<title>{{ config('app.name') }} | {{ (@$game ? __('Edit') . ' ' . \Str::Lower(__('Game')) . ': ' . $game->name  : __('Game') . ' ' . \Str::Lower(__('Add'))) }}</title>
@endsection

<x-adminLayout>

    <div class="{{ $cssNs }}">

        @include('admin.layouts.breadcrumb', [
            'title' => __('Game'),
            'description' => (@$game ? __('Game Introduction Edit') : __('Game Introduction Add')),
            'breadcrum' => [
                __('Game') => route('game.index'),
                (@$game ? __('Edit') . ' ' . \Str::Lower(__('Game')) . ': ' . $game->name  : __('Game') . ' ' . \Str::Lower(__('Add'))) => '#'
            ],
        ])

        @if ($errors->any())

            <div class="alert alert-fill-danger alert-dismissible fade show" role="alert">
                {{ __('Alert Error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
            </div>

        @endif

        @if(session('type'))

            <div class="alert alert-fill-{{ session('type') }} alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
            </div>

        @endif

        <form class="form-content" method="post" action="{{ (@$game ? route('game.update', $game) : route('game.store')) }}">

            @csrf

            @if(@$game)

            @method('PATCH')

            @endif

            <div class="row">

                <div class="col-md-12 grid-margin stretch-card">

                    <div class="card">

                        <div class="card-body">

                            <h6 class="card-title mt-4">{{ __('Game') }}</h6>
                            <p class="mb-4 text-muted small">{{ __('Content Introduction Game') }}</p>

                            <div class="col-md-12">

                                <x-form.date-time
                                    name="game_date"
                                    :label="__('Gamedate')"
                                    :value="(old('game_date') ? old('game_date') : (@$game ? $game->game_date : null))"
                                    :cols="['col-2', 'col-3']"
                                    :row="true"
                                />

                                <x-form.radio
                                    name="field"
                                    :label="__('Field')"
                                    :value="(old('field') ? old('field') : (@$game ? $game->field : null))"
                                    :cols="['col-2', 'col-3']"
                                    :options="[
                                        '1' => 1,
                                        '2' => 2,
                                    ]"
                                    :row="true"
                                />

                                <x-form.select
                                    name="team_home_id"
                                    :label="__('Home')"
                                    :cols="['col-2', 'col-3']"
                                    :value="(old('team_home_id') ? old('team_home_id') : (@$game ? $game->team_home_id : null))"
                                    :options="\App\Models\Team::all()->sortBy('name')"
                                    :valueWrapper="['id', 'name']"
                                    :disabledOption="__('Team Select')"
                                    :row="true"
                                />

                                <x-form.select
                                    name="team_away_id"
                                    :label="__('Away')"
                                    :cols="['col-2', 'col-3']"
                                    :value="(old('team_away_id') ? old('team_away_id') : (@$game ? $game->team_away_id : null))"
                                    :options="\App\Models\Team::all()->sortBy('name')"
                                    :valueWrapper="['id', 'name']"
                                    :disabledOption="__('Team Select')"
                                    :row="true"
                                />

                                <x-form.select
                                    name="referee_id"
                                    :label="__('Referee')"
                                    :cols="['col-2', 'col-3']"
                                    :value="(old('referee_id') ? old('referee_id') : (@$game ? $game->referee_id : null))"
                                    :options="\App\Models\Team::all()->sortBy('name')"
                                    :valueWrapper="['id', 'name']"
                                    :disabledOption="__('Select Referee')"
                                    :row="true"
                                />

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="form-submit">
                <button type="submit" class="btn btn-primary">{{ (@$game ? __('Edit') : __('Add')) }}</button>
            </div>

        </form>

    </div>

</x-adminLayout>
