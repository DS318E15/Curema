@extends('layouts.app')

@section('content')

    <header>
        <h1>Contacts</h1>

        <div class="button-group">
            <a href="{{ route('app.contact.create') }}" class="button">Create</a>
            <a href="{{ route('app.contact.trash') }}" class="button icon-trash"></a>
        </div>
    </header>

    @if(Session::has('alert-success'))
        <div class="alert success">
            {{ Session::get('alert-success') }}
        </div>
    @endif

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
                    <td><a href="{{ route('app.contact.show', $contact->id) }}">{{ $contact->name }}</a></td>
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