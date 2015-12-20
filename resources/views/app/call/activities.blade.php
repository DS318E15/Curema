@extends('layouts.app')

@section('content')

    <header>
        <h1>Call activities</h1>

        <a href="{{ route('app.call.show', $call->id) }}" class="button">Back</a>
    </header>

    @if(Session::has('alert-success'))
        <div class="alert success">
            {{ Session::get('alert-success') }}
        </div>
    @endif

    <section class="panel activities">

    </section>

@endsection