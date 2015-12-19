@extends('layouts.app')

@section('content')

    <header>
        <h1>Account activities</h1>

        <a href="{{ route('app.account.show', $account->id) }}" class="button">Back</a>
    </header>

    @if(Session::has('alert-success'))
        <div class="alert success">
            {{ Session::get('alert-success') }}
        </div>
    @endif

    <section class="panel activities">
        @include('app.account.activity')
    </section>

@endsection