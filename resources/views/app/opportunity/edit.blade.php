@extends('layouts.app')

@section('content')

    @if(Session::has('alert-success'))
        <div class="alert success">
            {{ Session::get('alert-success') }}
        </div>
    @endif

    <div class="panel">
        <header>
            <a href="{{ route('app.opportunity.show', $opportunity->id) }}" class="button">Back</a>
            <form method="POST"
                  action="{{ route($opportunity->active ? 'app.opportunity.destroy' : 'app.opportunity.restore', $opportunity->id) }}">
                {{ csrf_field() }}
                <button type="submit">{{ $opportunity->active ? 'Destroy' : 'Restore' }}</button>
            </form>
        </header>

        <form method="POST" action="{{ route('app.opportunity.update', $opportunity->id) }}">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

                    <!-- TODO add stage selection -->

            <div class="row">
                <fieldset class="col-xs-12">
                    <label>
                        Name*
                        <input type="text" name="name" value="{{ $opportunity->name }}">
                        @if($errors->has('name'))
                            <small class="error">{{ $errors->first('name') }}</small>
                        @endif
                    </label>
                </fieldset>
            </div>

            <div class="row">
                <fieldset class="col-xs-12">
                    <label>
                        Amount
                        <input type="text" name="amount" value="{{ $opportunity->amount }}">
                        @if($errors->has('amount'))
                            <small class="error">{{ $errors->first('amount') }}</small>
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
                                <option value="{{ $account->id }}"
                                        @if($account->id == $opportunity->account_id) selected @endif>{{ $account->name }}</option>
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
                                <option value="{{ $user->id }}"
                                        @if($user->id == $opportunity->user_id) selected @endif>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('user_id'))
                            <small class="error">{{ $errors->first('user_id') }}</small>
                        @endif
                    </label>
                </fieldset>
            </div>

            <br>

            <button type="submit" class="submit">Update</button>
        </form>
    </div>
@endsection