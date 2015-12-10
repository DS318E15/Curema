@extends('app.main')

@section('content')

    <section class="list">
        <header>
            <a href="{{ route('app.account.index') }}">Back</a>
            <h1>Accounts</h1>
        </header>

        <form action="">
            <label>
                Name:
                <input type="text">
            </label>
        </form>
    </section>

@endsection