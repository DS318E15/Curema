@extends('app.main')

@section('content')

    <section class="list">
        <header>
            <h1>Accounts</h1>
            <a href="account/create">Create</a>
        </header>

        <table>
            <thead>
            <tr>
                <th>Name</th>
            </tr>
            </thead>
            <tbody>
            @foreach($accounts as $account)
                <tr data-href="#"/>
                <td>{{ $account->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

@endsection