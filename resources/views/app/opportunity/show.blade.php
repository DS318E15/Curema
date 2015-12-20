@extends('layouts.app')

@section('content')

    @if(Session::has('alert-success'))
        <div class="alert success">
            {{ Session::get('alert-success') }}
        </div>
    @endif

    <div class="row">
        <section class="col-xs-8">
            <div class="panel">
                <header>
                    <a href="{{ route('app.opportunity.index') }}" class="button">Back</a>

                    @if($opportunity->trashed())
                        <form method="POST" action="{{ route('app.opportunity.restore', $opportunity->id) }}">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}

                            <div class="button-group">
                                <button type="submit">Restore</button>
                                <a href="{{ route('app.opportunity.edit', $opportunity->id) }}" class="button">Edit</a>
                            </div>
                        </form>
                    @else
                        <a href="{{ route('app.opportunity.edit', $opportunity->id) }}" class="button">Edit</a>
                    @endif
                </header>

                <form method="post" action="{{ route('app.opportunity.stage', $opportunity->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <section class="stages">
                        <div class="button-group">
                            @foreach($stages as $key => $stage)
                                @if($key < 3)
                                    <button type="submit" name="opportunity_stage_id" value="{{ $stage->id }}"
                                            @if($opportunity->opportunityStage->id == $stage->id) class="active" @endif>{{ $stage->name }}</button>
                                @endif
                            @endforeach
                        </div>
                        <div class="button-group">

                            @foreach($stages as $key => $stage)
                                @if($key >= 3)
                                    <button type="submit" name="opportunity_stage_id" value="{{ $stage->id }}"
                                            @if($opportunity->opportunityStage->id == $stage->id) class="active" @endif>{{ $stage->name }}</button>
                                @endif
                            @endforeach
                        </div>
                    </section>
                </form>

                <div class="input">
                    Name:
                    <div>{{ $opportunity->name }}</div>
                </div>

                <div class="input">
                    Amount:
                    <div>{{ $opportunity->amount }}</div>
                </div>

                <div class="input">
                    Account:
                    <div>
                        <a href="{{ route('app.account.show', $opportunity->account->id) }}">{{ $opportunity->account->name }}</a>
                    </div>
                </div>

                <div class="input">
                    Owner:
                    <div>
                        <a href="{{ route('app.employee.show', $opportunity->user->id) }}">{{ $opportunity->user->name }}</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="col-xs-4">
            <div class="panel activities">
                <header>
                    <h1>Activities</h1>
                    <a href="{{ route('app.opportunity.activities', $opportunity->id) }}" class="button">Show all</a>
                </header>
                @include('app.opportunity.activity')
            </div>
        </section>
    </div>

@endsection