@extends('layouts.app')

@section('content')

    <header>
        <h1>Deleted Contacts</h1>
        <a href="{{ route('app.contact.index') }}" class="button">Back</a>
    </header>

    <section class="panel">
        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Account Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Owner</th>
            </tr>
            </thead>
            <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td><a href="{{ route('app.contact.show', $contact->id) }}">{{ $contact->firstname }} {{ $contact->lastname }}</a></td>
                    <td><a href="{{ route('app.account.show', $contact->account->id) }}">{{ $contact->account->name }}</a></td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->email }}</td>
                    <td><a href="{{ route('app.employee.show', $contact->user->id) }}">{{ $contact->user->name }}</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

@endsection