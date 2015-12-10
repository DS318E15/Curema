@extends('app.main')

@section('content')


    <section>
        <a href="{{ route('app.account.index') }}">Back</a>
        <a href="{{ route('app.account.edit', $account->id) }}">Edit</a>
        <a href="{{ route('app.account.create') }}">Create</a>

        <h1>Account: {{ $account->name }}</h1>

        <div>
            <b>Name</b>
            <div>{{ $account->name }}</div>
        </div>
        <div>
            <b>Address</b>
            <div>{{ $account->street_name}} {{ $account->street_number }}, {{ $account->zip }} {{ $account->city }} {{ $account->country }}</div>
        </div>
        <div>
            <b>CVR</b>
            <div>{{ $account->cvr }}</div>
        </div>
        <div>
            <b>Phone</b>
            <div>{{ $account->phone }}</div>
        </div>
        <div>
            <b>Email</b>
            <div>{{ $account->email }}</div>
        </div>
        <div>
            <b>Website</b>
            <div>{{ $account->website }}</div>
        </div>
    </section>

@endsection