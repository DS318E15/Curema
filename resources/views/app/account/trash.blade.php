@extends('layouts.app')

@section('content')

    <header>
        <h1>Deleted Accounts</h1>
        <a href="{{ route('app.account.index') }}" class="button">Back</a>
    </header>

    <section class="panel">
        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Website</th>
                <th>Owner</th>
            </tr>
            </thead>
            <tbody>
            @foreach($accounts as $account)
                <tr>
                    <td><a href="{{ route('app.account.show', $account->id) }}">{{ $account->name }}</a></td>
                    <td>{{ $account->phone }}</td>
                    <td>{{ $account->email }}</td>
                    <td><a href="//{{ $account->website }}">{{ $account->website }}</a></td>
                    <td><a href="{{ route('app.employee.show', $account->user->id) }}">{{ $account->user->name }}</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

@endsection