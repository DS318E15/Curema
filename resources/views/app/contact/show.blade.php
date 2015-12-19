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
                    <a href="{{ route('app.contact.index') }}" class="button">Back</a>

                    @if(!$contact->active)
                        <form method="POST" action="{{ route('app.contact.restore', $contact->id) }}">
                            {{ csrf_field() }}
                            <div class="button-group">
                                <button type="submit">Restore</button>
                                <a href="{{ route('app.contact.edit', $contact->id) }}" class="button">Edit</a>
                            </div>
                        </form>
                    @else
                        <a href="{{ route('app.contact.edit', $contact->id) }}" class="button">Edit</a>
                    @endif
                </header>

                <div class="input">
                    Name:
                    <div>{{ $contact->name }}</div>
                </div>

                <div class="input">
                    Title:
                    <div>{{ $contact->title }}</div>
                </div>

                <div class="input">
                    Phone:
                    <div>{{ $contact->phone }}</div>
                </div>

                <div class="input">
                    Email:
                    <div>{{ $contact->email }}</div>
                </div>

                <div class="input">
                    Address:
                    <div>
                        {{ $contact->street_name}}
                        {{ $contact->street_number }}, {{ $contact->zip }}
                        {{ $contact->city }} {{ $contact->country }}
                    </div>
                </div>

                <div class="input">
                    Account:
                    <div><a href="{{ route('app.account.show', $contact->account->id) }}">{{ $contact->account->name }}</a></div>
                </div>

                <div class="input">
                    Owner:
                    <div><a href="{{ route('app.employee.show', $contact->user->id) }}">{{ $contact->user->name }}</a></div>
                </div>
            </div>
        </section>

        <section class="col-xs-4">
            <div class="panel activities">
                <header>
                    <h1>Activities</h1>
                    <a href="{{ route('app.contact.activities', $contact->id) }}" class="button">Show all</a>
                </header>
                @include('app.contact.activity')
            </div>
        </section>
    </div>

@endsection