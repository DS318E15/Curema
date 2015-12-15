@extends('app.main')

@section('content')

    @if(Session::has('alert-success'))
        <div class="alert success">
            {{ Session::get('alert-success') }}
        </div>
    @endif

    <div class="row">
        <section class="col-xs-8">
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
                                <input type="text" name="name" value="{{ $account->name }}">
                                @if($errors->has('name'))
                                    <small class="error">{{ $errors->first('name') }}</small>
                                @endif
                            </label>
                        </fieldset>

                        <fieldset class="col-xs-4">
                            <label>
                                CVR
                                <input type="text" name="cvr" value="{{ $account->cvr }}">
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
                                <input type="text" name="phone" value="{{ $account->phone }}">
                                @if($errors->has('phone'))
                                    <small class="error">{{ $errors->first('phone') }}</small>
                                @endif
                            </label>
                        </fieldset>

                        <fieldset class="col-xs-8">
                            <label>
                                Email
                                <input type="text" name="email" value="{{ $account->email }}">
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
                                <input type="text" name="website" value="{{ $account->website }}">
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
                                        <option value="{{ $user->id }}"
                                                @if($user->id == $account->user_id) selected @endif>{{ $user->name }}</option>
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
                                <input type="text" name="street_name" value="{{ $account->street_name }}">
                                @if($errors->has('street_name'))
                                    <small class="error">{{ $errors->first('street_name') }}</small>
                                @endif
                            </label>
                        </fieldset>

                        <fieldset class="col-xs-3">
                            <label>
                                Steet No.
                                <input type="text" name="street_number" value="{{ $account->street_number }}">
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
                                <input type="text" name="zip" value="{{ $account->zip }}">
                                @if($errors->has('zip'))
                                    <small class="error">{{ $errors->first('zip') }}</small>
                                @endif
                            </label>
                        </fieldset>

                        <fieldset class="col-xs-10">
                            <label>
                                City
                                <input type="text" name="city" value="{{ $account->city }}">
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
                                <input type="text" name="country" value="{{ $account->country }}">
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
        </section>

        <section class="col-xs-4">
            <div class="panel activities">
                <header>
                    <h1>Activities</h1>
                </header>
                @foreach($account->changes as $change)
                    <div class="activity">
                        <p>
                            <a href="{{ route('app.employee.show', $change->user_id) }}">{{ $change->user->name }}</a>
                            @if($change->type == "create")
                                created this account.
                            @elseif($change->type == "update")
                                updated this account.
                            @elseif($change->type == "destroy")
                                destroyed this account.
                            @elseif($change->type == "restore")
                                restored this account.
                            @endif
                        </p>
                        <small>{{ $change->created_at }}</small>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

@endsection