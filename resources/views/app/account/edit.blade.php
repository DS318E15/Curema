@extends('app.main')

@section('content')

    <div class="flex">
        <section class="panel content">
            <header>
                <a href="{{ route('app.account.index') }}" class="button">Back</a>
                <a href="{{ route('app.account.edit', $account->id) }}" class="button">Edit</a>
            </header>

            <div class="input">
                Name:
                <input type="text" value="{{ $account->name }}">
            </div>

            <div class="input">
                Address:
                <div>{{ $account->street_name}} {{ $account->street_number }}
                    , {{ $account->zip }} {{ $account->city }} {{ $account->country }}</div>
            </div>

            <div class="input">
                CVR:
                <input type="text" value="{{ $account->cvr }}">
            </div>

            <div class="input">
                Phone:
                <input type="text" value="{{ $account->phone }}">
            </div>

            <div class="input">
                Email:
                <input type="text" value="{{ $account->email }}">
            </div>

            <div class="input">
                Website:
                <input type="text" value="{{ $account->website }}">
            </div>
        </section>
        <section class="panel activities">activities</section>
    </div>

@endsection