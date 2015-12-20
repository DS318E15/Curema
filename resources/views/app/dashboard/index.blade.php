@extends('layouts.app')

@section('content')

    @if(Session::has('alert-success'))
        <div class="alert success">
            {{ Session::get('alert-success') }}
        </div>
    @endif

    <div class="row">
        <section class="col-xs-8">
            <div class="panel">
                @permission('view.opportunities')
                    <header>
                        <h1>Your active opportunities</h1>
                    </header>

                    <table>
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Account Name</th>
                            <th>Amount</th>
                            <th>Stage</th>
                            <th>Owner</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($opportunities as $opportunity)
                            <tr>
                                <td>
                                    <a href="{{ route('app.opportunity.show', $opportunity->id) }}">{{ $opportunity->name }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('app.account.show', $opportunity->account->id) }}">{{ $opportunity->account->name }}</a>
                                </td>
                                <td>{{ $opportunity->amount }}</td>
                                <td>{{ $opportunity->opportunityStage->name }}</td>
                                <td>
                                    <a href="{{ route('app.employee.show', $opportunity->user->id) }}">{{ $opportunity->user->name }}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <header>
                        <h1>Your cases</h1>
                    </header>

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
                                <td><a href="{{ route('app.ticket.show', $ticket->id) }}">{{ $ticket->subject }}</a>
                                </td>
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
                                <td>
                                    <a href="{{ route('app.employee.show', $ticket->user->id) }}">{{ $ticket->user->name }}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endpermission
            </div>
        </section>

        <section class="col-xs-4">
            <div class="panel activities">
                <header>
                    <h1>Activities</h1>
                </header>
                @include('app.dashboard.activity')
            </div>
        </section>
    </div>

@endsection