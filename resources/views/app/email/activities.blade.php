@extends('layouts.app')

@section('content')

    <header>
        <h1>Email activities</h1>

        <a href="{{ route('app.email.show', $email->id) }}" class="button">Back</a>
    </header>

    @if(Session::has('alert-success'))
        <div class="alert success">
            {{ Session::get('alert-success') }}
        </div>
    @endif

    <section class="panel activities">
        @include('app.email.activity')
    </section>

@endsection