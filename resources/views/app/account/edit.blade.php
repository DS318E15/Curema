@extends('layouts.app')

@section('content')

    @if(Session::has('alert-success'))
        <div class="alert success">
            {{ Session::get('alert-success') }}
        </div>
    @endif

    <div class="panel">
        <header>
            <a href="{{ route('app.account.show', $account->id) }}" class="button">Back</a>
            <form method="POST"
                  action="{{ route($account->active ? 'app.account.destroy' : 'app.account.restore', $account->id) }}">
                {{ csrf_field() }}
                <button type="submit">{{ $account->active ? 'Destroy' : 'Restore' }}</button>
            </form>
        </header>

        <form method="POST" action="{{ route('app.account.update', $account->id) }}">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            <div class="row">
                <fieldset class="col-xs-8">
                    <label>
                        Name
                        <input type="text" name="name" value="{{ old('name', $account->name) }}">
                        @if($errors->has('name'))
                            <small class="error">{{ $errors->first('name') }}</small>
                        @endif
                    </label>
                </fieldset>

                <fieldset class="col-xs-4">
                    <label>
                        CVR
                        <input type="text" name="cvr" value="{{ old('cvr', $account->cvr)}}">
                        @if($errors->has('cvr'))
                            <small class="error">{{ $errors->first('cvr') }}</small>
                        @endif
                    </label>
                </fieldset>
            </div>

            <div class="row">
                <fieldset class="col-xs-4">
                    <label>
                        Phone
                        <input type="text" name="phone" value="{{ old('phone', $account->phone) }}">
                        @if($errors->has('phone'))
                            <small class="error">{{ $errors->first('phone') }}</small>
                        @endif
                    </label>
                </fieldset>

                <fieldset class="col-xs-8">
                    <label>
                        Email
                        <input type="text" name="email" value="{{ old('email', $account->email) }}">
                        @if($errors->has('email'))
                            <small class="error">{{ $errors->first('email') }}</small>
                        @endif
                    </label>
                </fieldset>
            </div>

            <div class="row">
                <fieldset class="col-xs-6">
                    <label>
                        Website
                        <input type="text" name="website" value="{{ old('website', $account->website) }}">
                        @if($errors->has('website'))
                            <small class="error">{{ $errors->first('website') }}</small>
                        @endif
                    </label>
                </fieldset>

                <fieldset class="col-xs-6">
                    <label>
                        Owner
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

            <div class="row">
                <fieldset class="col-xs-9">
                    <label>
                        Street Name
                        <input type="text" name="street_name" value="{{ old('street_name', $account->street_name) }}">
                        @if($errors->has('street_name'))
                            <small class="error">{{ $errors->first('street_name') }}</small>
                        @endif
                    </label>
                </fieldset>

                <fieldset class="col-xs-3">
                    <label>
                        Steet No.
                        <input type="text" name="street_number" value="{{ old('street_number', $account->street_number) }}">
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
                        <input type="text" name="zip" value="{{ old('zip', $account->zip) }}">
                        @if($errors->has('zip'))
                            <small class="error">{{ $errors->first('zip') }}</small>
                        @endif
                    </label>
                </fieldset>

                <fieldset class="col-xs-10">
                    <label>
                        City
                        <input type="text" name="city" value="{{ old('city', $account->city )}}">
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
                        <input type="text" name="country" value="{{ old('country', $account->country) }}">
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