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
                    <a href="{{ route('app.call.index') }}" class="button">Back</a>
                    <a href="{{ route('app.call.edit', $call->id) }}" class="button">Edit</a>
                </header>

                <div class="input">
                    Call To
                    <div>
                        @if(count($call->lead))
                            <a href="{{ route('app.lead.show', $call->id) }}">{{ $call->lead->name }}</a>
                        @elseif(count($call->contact))
                            <a href="{{ route('app.contact.show', $call->id) }}">{{ $call->contact->name }}</a>
                        @elseif(count($call->account))
                            <a href="{{ route('app.account.show', $call->id) }}">{{ $call->account->name }}</a>
                        @endif
                    </div>
                </div>

                <div class="input">
                    Call From
                    <div>
                        <a href="{{ route('app.employee.show', $call->user->id) }}">{{ $call->user->name }}</a>
                    </div>
                </div>

                <div class="input">
                    Call From
                    <div>{{ $call->content }}</div>
                </div>
            </div>
        </section>

        <section class="col-xs-4">
            <div class="panel activities">
                <header>
                    <h1>Activities</h1>
                </header>
                @foreach($call->changes as $change)
                    <div class="activity">
                        <p>
                            <a href="{{ route('app.employee.show', $change->user_id) }}">{{ $change->user->name }}</a>
                            @if($change->type == "create")
                                created this call.
                            @elseif($change->type == "update")
                                updated this call.
                            @elseif($change->type == "destroy")
                                destroyed this call.
                            @elseif($change->type == "restore")
                                restored this call.
                            @endif
                        </p>
                        <small>{{ $change->created_at }}</small>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

@endsection