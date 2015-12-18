@extends('layouts.app')

@section('content')

    <header>
        <h1>Calls</h1>

        <a href="{{ route('app.call.create') }}" class="button">Create</a>
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
                <th>Call To</th>
                <th>Call From</th>
                <th>Call Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($calls as $call)
                <tr>
                    @if(count($call->lead))
                        <td><a href="{{ route('app.call.show', $call->id) }}">{{ $call->lead->name }}</a></td>
                    @elseif(count($call->contact))
                        <td><a href="{{ route('app.call.show', $call->id) }}">{{ $call->contact->name }}</a></td>
                    @elseif(count($call->account))
                        <td><a href="{{ route('app.call.show', $call->id) }}">{{ $call->account->name }}</a></td>
                    @endif
                        <td><a href="{{ route('app.employee.show', $call->user->id) }}">{{ $call->user->name }}</a></td>
                        <td>{{ $call->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

@endsection