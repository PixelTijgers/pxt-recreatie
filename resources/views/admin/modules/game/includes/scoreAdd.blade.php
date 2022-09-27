<div class="col-md-12">

    <div class="row">

        <div class="col-md-6">

            <h6 class="card-title mt-4">{{ __('Home') }}</h6>

            <h6 class="card-title mt-4">{{ __('Set') }} 1</h6>

            <x-form.input
                type="text"
                name="scores[0][team_home_score]"
                :required="false"
            />

        </div>

        <div class="col-md-6">

            <h6 class="card-title mt-4">{{ __('Away') }}</h6>

            <h6 class="card-title mt-4">{{ __('Set') }} 1</h6>

            <x-form.input
                type="text"
                name="scores[0][team_away_score]"
                :required="false"
            />

        </div>

    </div>

    <div class="row">

        <div class="col-md-6">

            <h6 class="card-title mt-4">{{ __('Set') }} 2</h6>

            <x-form.input
                type="text"
                name="scores[1][team_home_score]"
                :required="false"
            />

        </div>

        <div class="col-md-6">

            <h6 class="card-title mt-4">{{ __('Set') }} 2</h6>

            <x-form.input
                type="text"
                name="scores[1][team_away_score]"
                :required="false"
            />

        </div>

    </div>

    <div class="row">

        <div class="col-md-6">

            <h6 class="card-title mt-4">{{ __('Set') }} 3</h6>

            <x-form.input
                type="text"
                name="scores[2][team_home_score]"
                :required="false"
            />

        </div>

        <div class="col-md-6">

            <h6 class="card-title mt-4">{{ __('Set') }} 3</h6>

            <x-form.input
                type="text"
                name="scores[2][team_away_score]"
                :required="false"
            />

        </div>

    </div>

</div>
