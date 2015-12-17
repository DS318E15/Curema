@extends('layouts.app')

@section('content')

    <header>
        <h1>Destroyed Cases</h1>
        <a href="{{ route('app.ticket.index') }}" class="button">Back</a>
    </header>

    <section class="panel">
        <table>
            <thead>
            <tr>
                <th>Subject</th>
                <th>Account Name</th>
                <th>Contact Name</th>
                <th>Owner</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td><a href="{{ route('app.ticket.show', $ticket->id) }}">{{ $ticket->subject }}</a></td>
                    <td><a href="{{ route('app.account.show', $ticket->account->id) }}">{{ $ticket->account->name }}</a></td>
                    <td><a href="{{ route('app.contact.show', $ticket->contact->id) }}">{{ $ticket->contact->name }}</a></td>
                    <td><a href="{{ route('app.employee.show', $ticket->user->id) }}">{{ $ticket->user->name }}</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

@endsection