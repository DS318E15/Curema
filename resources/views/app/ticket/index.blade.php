@extends('layouts.app')

@section('content')

    <header>
        <h1>Cases</h1>

        <div class="button-group">
            <a href="{{ route('app.ticket.create') }}" class="button">Create</a>
            <a href="{{ route('app.ticket.trash') }}" class="button icon-trash"></a>
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
                    <td>
                        @if(count($ticket->account))
                            <a href="{{ route('app.account.show', $ticket->account->id) }}">{{ $ticket->account->name }}</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if(count($ticket->contact))
                            <a href="{{ route('app.contact.show', $ticket->contact->id) }}">{{ $ticket->contact->name }}</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td><a href="{{ route('app.employee.show', $ticket->user->id) }}">{{ $ticket->user->name }}</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

@endsection