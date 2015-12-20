@extends('layouts.app')

@section('content')

    <header>
        <h1>Contact activities</h1>

        <a href="{{ route('app.contact.show', $contact->id) }}" class="button">Back</a>
    </header>

    @if(Session::has('alert-success'))
        <div class="alert success">
            {{ Session::get('alert-success') }}
        </div>
    @endif

    <section class="panel activities">
        @include('app.contact.activity')
    </section>

@endsection