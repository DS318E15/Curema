@extends('layouts.app')

@section('content')

    @if(Session::has('alert-success'))
        <div class="alert success">
            {{ Session::get('alert-success') }}
        </div>
    @endif

    <div class="panel">
        <header>
            <a href="{{ route('app.ticket.index') }}" class="button">Back</a>
        </header>

        <form method="POST" action="{{ route('app.ticket.store') }}">
            {{ csrf_field() }}

            <div class="row">
                <fieldset class="col-xs-12">
                    <label>
                        Subject*
                        <input type="text" name="subject" value="{{ old('subject') }}">
                        @if($errors->has('subject'))
                            <small class="error">{{ $errors->first('subject') }}</small>
                        @endif
                    </label>
                </fieldset>
            </div>

            <div class="row">
                <fieldset class="col-xs-12">
                    <label>
                        Description*
                        <textarea name="description">{{ old('description') }}</textarea>
                        @if($errors->has('description'))
                            <small class="error">{{ $errors->first('description') }}</small>
                        @endif
                    </label>
                </fieldset>
            </div>

            <br>

            <div class="row">
                <fieldset class="col-xs-6">
                    <label>
                        Account
                        <select name="account_id">
                            <option value=""></option>
                            @foreach($accounts as $account)
                                @if($account->id == old('account_id'))
                                    <option value="{{ $account->id }}" selected>{{ $account->name }}</option>
                                @else
                                    <option value="{{ $account->id }}">{{ $account->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if($errors->has('account_id'))
                            <small class="error">{{ $errors->first('account_id') }}</small>
                        @endif
                    </label>
                </fieldset>

                <fieldset class="col-xs-6">
                    <label>
                        Contact
                        <select name="contact_id">
                            <option value=""></option>
                            @foreach($contacts as $contact)
                                @if($contact->id == old('contact_id'))
                                    <option value="{{ $contact->id }}" selected>{{ $contact->name }}</option>
                                @else
                                    <option value="{{ $contact->id }}">{{ $contact->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if($errors->has('contact_id'))
                            <small class="error">{{ $errors->first('contact_id') }}</small>
                        @endif
                    </label>
                </fieldset>
            </div>

            <div class="row">
                <fieldset class="col-xs-12">
                    <label>
                        Owner*
                        <select name="user_id">
                            @foreach($users as $user)
                                @if($user->id == old('user_id', Auth::user()->id))
                                    <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                @else
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if($errors->has('user_id'))
                            <small class="error">{{ $errors->first('user_id') }}</small>
                        @endif
                    </label>
                </fieldset>
            </div>

            <br>

            <button type="submit" class="submit">Create</button>
        </form>
    </div>

@endsection