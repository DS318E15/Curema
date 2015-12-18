@extends('layouts.app')

@section('content')

    @if(Session::has('alert-success'))
        <div class="alert success">
            {{ Session::get('alert-success') }}
        </div>
    @endif

    <div class="panel">
        <header>
            <a href="{{ route('app.call.index') }}" class="button">Back</a>
        </header>

        <form method="POST" action="{{ route('app.call.store') }}">
            {{ csrf_field() }}

            <div class="row">
                <fieldset class="col-xs-12">
                    <label>
                        Call to lead
                        <select name="lead_id">
                            <option value=""></option>
                            @foreach($leads as $lead)
                                <option value="{{ $lead->id }}">{{ $lead->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('lead_id'))
                            <small class="error">{{ $errors->first('lead_id') }}</small>
                        @endif
                    </label>
                </fieldset>
            </div>

            <div class="row">
                <fieldset class="col-xs-12">
                    <label>
                        Call to contact
                        <select name="contact_id">
                            <option value=""></option>
                            @foreach($contacts as $contact)
                                <option value="{{ $contact->id }}">{{ $contact->name }}</option>
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
                        Call to account
                        <select name="account_id">
                            <option value=""></option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}">{{ $account->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('account_id'))
                            <small class="error">{{ $errors->first('account_id') }}</small>
                        @endif
                    </label>
                </fieldset>
            </div>

            <br>

            <div class="row">
                <fieldset class="col-xs-12">
                    <label>
                        Content*
                        <textarea name="content"></textarea>
                        @if($errors->has('content'))
                            <small class="error">{{ $errors->first('content') }}</small>
                        @endif
                    </label>
                </fieldset>
            </div>

            <div class="row">
                <fieldset class="col-xs-12">
                    <label>
                        Call From*
                        <select name="user_id">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}"
                                        @if($user->id == Auth::user()->id) selected @endif>{{ $user->name }}</option>
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