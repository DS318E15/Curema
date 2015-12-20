@extends('layouts.app')

@section('content')

    <header>
        <h1>Opportunity activities</h1>

        <a href="{{ route('app.opportunity.show', $opportunity->id) }}" class="button">Back</a>
    </header>

    @if(Session::has('alert-success'))
        <div class="alert success">
            {{ Session::get('alert-success') }}
        </div>
    @endif

    <section class="panel activities">
        @include('app.opportunity.activity')
    </section>

@endsection