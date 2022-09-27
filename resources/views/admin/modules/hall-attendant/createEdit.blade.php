@section('meta')
<title>{{ config('app.name') }} | {{ (@$hall_attendant ? __('Edit') . ' ' . \Str::Lower(__('Hall Moniter')) . ': ' . $hall_attendant->name  : __('Hall Moniter') . ' ' . \Str::Lower(__('Add'))) }}</title>
@endsection

<x-adminLayout>

    <div class="{{ $cssNs }}">

        @include('admin.layouts.breadcrumb', [
            'title' => __('Hall Moniter'),
            'description' => (@$hall_attendant ? __('Hall Moniter Introduction Edit') : __('Hall Moniter Introduction Add')),
            'breadcrum' => [
                __('Hall Moniter') => route('hallAttendant.index'),
                (@$hall_attendant ? __('Edit') . ' ' . \Str::Lower(__('Hall Moniter')) . ': ' . $hall_attendant->name  : __('Hall Moniter') . ' ' . \Str::Lower(__('Add'))) => '#'
            ],
        ])

        @if ($errors->any())

            <div class="alert alert-fill-danger alert-dismissible fade show" role="alert">
                {{ __('Alert Error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
            </div>

        @endif

        <form class="form-content" method="post" action="{{ (@$hall_attendant ? route('hallAttendant.update', $hall_attendant) : route('hallAttendant.store')) }}">

            @csrf

            @if(@$hall_attendant)

            @method('PATCH')

            @endif

            <div class="row">

                <div class="col-md-12 grid-margin stretch-card">

                    <div class="card">

                        <div class="card-body">

                            <h6 class="card-title mt-4">{{ __('Hall Moniter') }}</h6>
                            <p class="mb-4 text-muted small">{{ __('Content Introduction Hall Moniter') }}</p>

                            <div class="col-md-12">

                                <x-form.select
                                    name="team_id"
                                    :label="__('Team')"
                                    :cols="['col-2', 'col-3']"
                                    :value="(old('team_id') ? old('team_id') : (@$hall_attendant ? $hall_attendant->team_id : null))"
                                    :options="\App\Models\Team::all()->sortBy('name')"
                                    :valueWrapper="['id', 'name']"
                                    :disabledOption="__('Team Select')"
                                    :row="true"
                                />

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="form-submit">
                <button type="submit" class="btn btn-primary">{{ (@$hall_attendant ? __('Edit') : __('Add')) }}</button>
            </div>

        </form>

    </div>

</x-adminLayout>
