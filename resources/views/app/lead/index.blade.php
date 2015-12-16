@extends('layouts.app')

@section('content')

    <header>
        <h1>Leads</h1>

        <div class="button-group">
            <a href="{{ route('app.lead.create') }}" class="button">Create</a>
            <a href="{{ route('app.lead.trash') }}" class="button icon-trash"></a>
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
                    <td><a href="{{ route('app.employee.show', $lead->user->id) }}">{{ $lead->user->name }}</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

@endsection