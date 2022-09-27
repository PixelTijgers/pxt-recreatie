<div class="col-md-12">

    <div class="row">

        <div class="col-md-6">

            <h6 class="card-title mt-4">{{ __('Home') }}</h6>

        </div>

        <div class="col-md-6">

            <h6 class="card-title mt-4">{{ __('Away') }}</h6>

        </div>

    </div>

    @foreach(\App\Models\Result::where('game_id', $game->id)->get() as $key => $result)
    <div class="row">

        <div class="col-md-6">

            <h6 class="card-title mt-4">{{ __('Set') }} {{ $loop->index + 1 }}</h6>

            <x-form.input
                type="text"
                name="scores[{{$key}}][team_home_score]"
                :required="false"
                value="{{ $result->team_home_score }}"
            />

        </div>

        <div class="col-md-6">

            <h6 class="card-title mt-4">{{ __('Set') }} {{ $loop->index + 1 }}</h6>

            <x-form.input
                type="text"
                name="scores[{{$key}}][team_away_score]"
                :required="false"
                value="{{ $result->team_away_score }}"
            />

        </div>

    </div>
    @endforeach

</div>
