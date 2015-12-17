@extends('layouts.app')

@section('content')

    <header>
        <h1>Destroyed Opportunities</h1>
        <a href="{{ route('app.opportunity.index') }}" class="button">Back</a>
    </header>

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