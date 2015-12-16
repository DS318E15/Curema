@extends('layouts.app')

@section('content')

    <header>
        <h1>Destroyed Leads</h1>
        <a href="{{ route('app.lead.index') }}" class="button">Back</a>
    </header>

    <section class="panel">
        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Title</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Owner</th>
            </tr>
            </thead>
            <tbody>
            @foreach($leads as $lead)
                <tr>
                    <td><a href="{{ route('app.lead.show', $lead->id) }}">{{ $lead->name }}</a></td>
                    <td>{{ $lead->title }}</td>
                    <td>{{ $lead->phone }}</td>
                    <td>{{ $lead->email }}</td>
                    <td><a href="{{ route('app.lead.show', $lead->user->id) }}">{{ $lead->user->name }}</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

@endsection