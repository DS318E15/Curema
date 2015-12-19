@extends('layouts.app')

@section('content')

    <header>
        <h1>Case activities</h1>

        <a href="{{ route('app.ticket.show', $ticket->id) }}" class="button">Back</a>
    </header>

    @if(Session::has('alert-success'))
        <div class="alert success">
            {{ Session::get('alert-success') }}
        </div>
    @endif

    <section class="panel activities">
        @include('app.ticket.activity')
    </section>

@endsection