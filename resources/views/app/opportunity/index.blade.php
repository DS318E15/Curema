@extends('layouts.app')

@section('content')

    <header>
        <h1>Opportunities</h1>

        <div class="button-group">
            <a href="{{ route('app.opportunity.create') }}" class="button">Create</a>
            <a href="{{ route('app.opportunity.trash') }}" class="button icon-trash"></a>
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
                <th>Amount</th>
                <th>Stage</th>
                <th>Closing At</th>
                <th>Owner</th>
            </tr>
            </thead>
            <tbody>
            @foreach($opportunities as $opportunity)
                <tr>
                    <td><a href="{{ route('app.opportunity.show', $opportunity->id) }}">{{ $opportunity->name }}</a></td>
                    <td><a href="{{ route('app.account.show', $opportunity->account->id) }}">{{ $opportunity->account->name }}</a></td>
                    <td>{{ $opportunity->amount }}</td>
                    <td>{{ $opportunity->opportunityStage->name }}</td>
                    <td>{{ $opportunity->closing_at }}</td>
                    <td><a href="{{ route('app.employee.show', $opportunity->user->id) }}">{{ $opportunity->user->name }}</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

@endsection