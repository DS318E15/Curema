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
                <header>
                    <a href="{{ route('app.ticket.index') }}" class="button">Back</a>

                    @if(!$ticket->active)
                        <form method="POST" action="{{ route('app.ticket.restore', $ticket->id) }}">
                            {{ csrf_field() }}
                            <div class="button-group">
                                <button type="submit">Restore</button>
                                <a href="{{ route('app.ticket.edit', $ticket->id) }}" class="button">Edit</a>
                            </div>
                        </form>
                    @else
                        <a href="{{ route('app.ticket.edit', $ticket->id) }}" class="button">Edit</a>
                    @endif
                </header>

                <div class="input">
                    Subject:
                    <div>{{ $ticket->subject }}</div>
                </div>

                <div class="input">
                    Description:
                    <div>{{ $ticket->description }}</div>
                </div>

                <div class="input">
                    Account:
                    <div>
                        @if(count($ticket->account))
                            <a href="{{ route('app.account.show', $ticket->account->id) }}">{{ $ticket->account->name }}</a>
                        @else
                            N/A
                        @endif
                    </div>
                </div>

                <div class="input">
                    Contact:
                    <div>
                        @if(count($ticket->contact))
                            <a href="{{ route('app.contact.show', $ticket->contact->id) }}">{{ $ticket->contact->name }}</a>
                        @else
                            N/A
                        @endif
                    </div>
                </div>

                <div class="input">
                    Owner:
                    <div>
                        <a href="{{ route('app.employee.show', $ticket->user->id) }}">{{ $ticket->user->name }}</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="col-xs-4">
            <div class="panel activities">
                <header>
                    <h1>Activities</h1>
                </header>
                @foreach($ticket->changes as $change)
                    <div class="activity">
                        <p>
                            <a href="{{ route('app.employee.show', $change->user_id) }}">{{ $change->user->name }}</a>
                            @if($change->type == "create")
                                created this ticket.
                            @elseif($change->type == "update")
                                updated this ticket.
                            @elseif($change->type == "destroy")
                                destroyed this ticket.
                            @elseif($change->type == "restore")
                                restored this ticket.
                            @endif
                        </p>
                        <small>{{ $change->created_at }}</small>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

@endsection