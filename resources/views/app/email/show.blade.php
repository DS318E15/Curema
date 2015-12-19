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
                    <a href="{{ route('app.email.activities', $email->id) }}" class="button">Show all</a>
                </header>
               @include('app.email.activity')
            </div>
        </section>
    </div>

@endsection