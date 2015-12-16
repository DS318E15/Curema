@extends('layouts.app')

@section('content')

    @if(Session::has('alert-success'))
        <div class="alert success">
            {{ Session::get('alert-success') }}
        </div>
    @endif

    <div class="panel">
        <header>
            <a href="{{ route('app.contact.index') }}" class="button">Back</a>
        </header>

        <form method="POST" action="{{ route('app.contact.store') }}">
            {{ csrf_field() }}

            <div class="row">
                <fieldset class="col-xs-8">
                    <label>
                        Name*
                        <input type="text" name="firstname">
                        @if($errors->has('firstname'))
                            <small class="error">{{ $errors->first('firstname') }}</small>
                        @endif
                    </label>
                </fieldset>

                <fieldset class="col-xs-4">
                    <label>
                        Title
                        <input type="text" name="title">
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
                        <input type="text" name="phone">
                        @if($errors->has('phone'))
                            <small class="error">{{ $errors->first('phone') }}</small>
                        @endif
                    </label>
                </fieldset>

                <fieldset class="col-xs-8">
                    <label>
                        Email
                        <input type="text" name="email">
                        @if($errors->has('email'))
                            <small class="error">{{ $errors->first('email') }}</small>
                        @endif
                    </label>
                </fieldset>
            </div>

            <div class="row">
                <fieldset class="col-xs-6">
                    <label>
                        Account*
                        <select name="account_id">
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}">{{ $account->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('account_id'))
                            <small class="error">{{ $errors->first('account_id') }}</small>
                        @endif
                    </label>
                </fieldset>

                <fieldset class="col-xs-6">
                    <label>
                        Owner*
                        <select name="user_id">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('user_id'))
                            <small class="error">{{ $errors->first('user_id') }}</small>
                        @endif
                    </label>
                </fieldset>
            </div>

            <br>

            <div class="row">
                <fieldset class="col-xs-9">
                    <label>
                        Street Name
                        <input type="text" name="street_name">
                        @if($errors->has('street_name'))
                            <small class="error">{{ $errors->first('street_name') }}</small>
                        @endif
                    </label>
                </fieldset>

                <fieldset class="col-xs-3">
                    <label>
                        Steet No.
                        <input type="text" name="street_number">
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
                        <input type="text" name="zip">
                        @if($errors->has('zip'))
                            <small class="error">{{ $errors->first('zip') }}</small>
                        @endif
                    </label>
                </fieldset>

                <fieldset class="col-xs-10">
                    <label>
                        City
                        <input type="text" name="city">
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
                        <input type="text" name="country">
                        @if($errors->has('country'))
                            <small class="error">{{ $errors->first('country') }}</small>
                        @endif
                    </label>
                </fieldset>
            </div>

            <br>

            <button type="submit" class="submit">Create</button>
        </form>
    </div>

@endsection