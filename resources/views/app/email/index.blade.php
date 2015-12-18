@extends('layouts.app')

@section('content')

    <header>
        <h1>Emails</h1>

        <a href="{{ route('app.email.create') }}" class="button">Create</a>
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
                <th>Email To</th>
                <th>Email From</th>
                <th>Email Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($emails as $email)
                <tr>
                    @if(count($email->lead))
                        <td><a href="{{ route('app.email.show', $email->id) }}">{{ $email->lead->name }}</a></td>
                    @elseif(count($email->contact))
                        <td><a href="{{ route('app.email.show', $email->id) }}">{{ $email->contact->name }}</a></td>
                    @elseif(count($email->account))
                        <td><a href="{{ route('app.email.show', $email->id) }}">{{ $email->account->name }}</a></td>
                    @endif
                        <td><a href="{{ route('app.employee.show', $email->user->id) }}">{{ $email->user->name }}</a></td>
                        <td>{{ $email->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

@endsection