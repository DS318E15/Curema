@extends('layouts.app')

@section('content')

    @if(Session::has('alert-success'))
        <div class="alert success">
            {{ Session::get('alert-success') }}
        </div>
    @endif

    <div class="panel">
        <header>
            <a href="{{ route('app.employee.show', $employee->id) }}" class="button">Back</a>
            @if($employee->trashed())
                <form method="POST" action="{{ route('app.employee.restore', $employee->id) }}">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}

                    <button type="submit">Restore</button>
                </form>
            @else
                <form method="post" action="{{ route('app.employee.destroy', $employee->id) }}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}

                    <button type="submit">Delete</button>
                </form>
            @endif
        </header>

        <form method="POST" action="{{ route('app.employee.update', $employee->id) }}">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            <div class="row">
                <fieldset class="col-xs-8">
                    <label>
                        Name*
                        <input type="text" name="name" value="{{ old('name', $employee->name) }}">
                        @if($errors->has('name'))
                            <small class="error">{{ $errors->first('name') }}</small>
                        @endif
                    </label>
                </fieldset>

                <fieldset class="col-xs-4">
                    <label>
                        Title
                        <input type="text" name="title" value="{{ old('title', $employee->title) }}">
                        @if($errors->has('title'))
                            <small class="error">{{ $errors->first('title') }}</small>
                        @endif
                    </label>
                </fieldset>
            </div>

            <div class="row">
                <fieldset class="col-xs-4">
                    <label>
                        Phone
                        <input type="text" name="phone" value="{{ old('phone', $employee->phone) }}">
                        @if($errors->has('phone'))
                            <small class="error">{{ $errors->first('phone') }}</small>
                        @endif
                    </label>
                </fieldset>

                <fieldset class="col-xs-8">
                    <label>
                        Email*
                        <input type="text" name="email" value="{{ old('email', $employee->email) }}">
                        @if($errors->has('email'))
                            <small class="error">{{ $errors->first('email') }}</small>
                        @endif
                    </label>
                </fieldset>
            </div>

            <br>

            <div class="row">
                <div class="col-xs-6">
                    <fieldset>
                        <label>
                            Password*
                            <input type="password" name="password">
                            @if($errors->has('password'))
                                <small class="error">{{ $errors->first('password') }}</small>
                            @endif
                        </label>
                    </fieldset>

                    <fieldset>
                        <label>
                            Password Confirmation*
                            <input type="password" name="password_confirmation">
                            @if($errors->has('password_confirmation'))
                                <small class="error">{{ $errors->first('password_confirmation') }}</small>
                            @endif
                        </label>
                    </fieldset>
                </div>

                <fieldset class="col-xs-6">
                    <label>
                        Role*
                        <select name="role_id">
                            @foreach($roles as $role)
                                @if(isset($employee->roles->first()->id) && $role->id == old('role_id', $employee->roles->first()->id))
                                    <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                @else
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if($errors->has('role_id'))
                            <small class="error">{{ $errors->first('role_id') }}</small>
                        @endif
                    </label>
                </fieldset>
            </div>

            <br>

            <div class="row">
                <fieldset class="col-xs-9">
                    <label>
                        Street Name
                        <input type="text" name="street_name" value="{{ old('street_name', $employee->street_name) }}">
                        @if($errors->has('street_name'))
                            <small class="error">{{ $errors->first('street_name') }}</small>
                        @endif
                    </label>
                </fieldset>

                <fieldset class="col-xs-3">
                    <label>
                        Steet No.
                        <input type="text" name="street_number" value="{{ old('street_number', $employee->street_number) }}">
                        @if($errors->has('street_number'))
                            <small class="error">{{ $errors->first('street_number') }}</small>
                        @endif
                    </label>
                </fieldset>
            </div>

            <div class="row">
                <fieldset class="col-xs-2">
                    <label>
                        Zip
                        <input type="text" name="zip" value="{{ old('zip', $employee->zip) }}">
                        @if($errors->has('zip'))
                            <small class="error">{{ $errors->first('zip') }}</small>
                        @endif
                    </label>
                </fieldset>

                <fieldset class="col-xs-10">
                    <label>
                        City
                        <input type="text" name="city" value="{{ old('city', $employee->city) }}">
                        @if($errors->has('city'))
                            <small class="error">{{ $errors->first('city') }}</small>
                        @endif
                    </label>
                </fieldset>
            </div>

            <div class="row">
                <fieldset class="col-xs-12">
                    <label>
                        Country
                        <input type="text" name="country" value="{{ old('country', $employee->country) }}">
                        @if($errors->has('country'))
                            <small class="error">{{ $errors->first('country') }}</small>
                        @endif
                    </label>
                </fieldset>
            </div>

            <br>

            <button type="submit" class="submit">Update</button>
        </form>
    </div>

@endsection