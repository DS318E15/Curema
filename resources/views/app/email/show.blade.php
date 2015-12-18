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
                    <a href="{{ route('app.email.index') }}" class="button">Back</a>
                    <a href="{{ route('app.email.edit', $email->id) }}" class="button">Edit</a>
                </header>

                <div class="input">
                    Email To
                    <div>
                        @if(count($email->lead))
                            <a href="{{ route('app.lead.show', $email->id) }}">{{ $email->lead->name }}</a>
                        @elseif(count($email->contact))
                            <a href="{{ route('app.contact.show', $email->id) }}">{{ $email->contact->name }}</a>
                        @elseif(count($email->account))
                            <a href="{{ route('app.account.show', $email->id) }}">{{ $email->account->name }}</a>
                        @endif
                    </div>
                </div>

                <div class="input">
                    Email From
                    <div>
                        <a href="{{ route('app.employee.show', $email->user->id) }}">{{ $email->user->name }}</a>
                    </div>
                </div>

                <div class="input">
                    Email From
                    <div>{{ $email->content }}</div>
                </div>
            </div>
        </section>

        <section class="col-xs-4">
            <div class="panel activities">
                <header>
                    <h1>Activities</h1>
                </header>
                @foreach($email->changes as $change)
                    <div class="activity">
                        <p>
                            <a href="{{ route('app.employee.show', $change->user_id) }}">{{ $change->user->name }}</a>
                            @if($change->type == "create")
                                created this email.
                            @elseif($change->type == "update")
                                updated this email.
                            @elseif($change->type == "destroy")
                                destroyed this email.
                            @elseif($change->type == "restore")
                                restored this email.
                            @endif
                        </p>
                        <small>{{ $change->created_at }}</small>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

@endsection