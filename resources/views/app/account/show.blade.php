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
                <div>{{ $account->name }}</div>
            </div>

            <div class="input">
                Address:
                <div>{{ $account->street_name}} {{ $account->street_number }}
                    , {{ $account->zip }} {{ $account->city }} {{ $account->country }}</div>
            </div>

            <div class="input">
                CVR:
                <div>{{ $account->cvr }}</div>
            </div>

            <div class="input">
                Phone:
                <div>{{ $account->phone }}</div>
            </div>

            <div class="input">
                Email:
                <div>{{ $account->email }}</div>
            </div>

            <div class="input">
                Website:
                <div><a href="//{{ $account->website }}">{{ $account->website }}</a></div>
            </div>
        </section>
        <section class="panel activities">activities</section>
    </div>

@endsection