@extends('layouts.app')

@section('content')

    <header>
        <h1>Employees</h1>
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
                <th>Updated At</th>
                <th>Created At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td><a href="{{ route('app.employee.show', $employee->id) }}">{{ $employee->name }}</a></td>
                    <td>{{ $employee->updated_at }}</td>
                    <td>{{ $employee->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

@endsection