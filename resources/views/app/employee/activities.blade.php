@extends('layouts.app')

@section('content')

    <header>
        <h1>Employee activities</h1>

        <a href="{{ route('app.employee.show', $employee->id) }}" class="button">Back</a>
    </header>

    @if(Session::has('alert-success'))
        <div class="alert success">
            {{ Session::get('alert-success') }}
        </div>
    @endif

    <section class="panel activities">
        @include('app.employee.activity')
    </section>

@endsection