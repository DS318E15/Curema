@extends('layouts.app')

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
                    <a href="{{ route('app.contact.show', $contact->id) }}" class="button">Back</a>
                    <form method="POST"
                          action="{{ route($contact->active ? 'app.contact.destroy' : 'app.contact.restore', $contact->id) }}">
                        {{ csrf_field() }}
                        <button type="submit">{{ $contact->active ? 'Destroy' : 'Restore' }}</button>
                    </form>
                </header>

                <form method="POST" action="{{ route('app.contact.update', $contact->id) }}">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}

                    <div class="row">
                        <fieldset class="col-xs-8">
                            <label>
                                Name*
                                <input type="text" name="name" value="{{ $contact->name }}">
                                @if($errors->has('name'))
                                    <small class="error">{{ $errors->first('name') }}</small>
                                @endif
                            </label>
                        </fieldset>

                        <fieldset class="col-xs-4">
                            <label>
                                Title
                                <input type="text" name="title" value="{{ $contact->title }}">
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
                                <input type="text" name="phone" value="{{ $contact->phone }}">
                                @if($errors->has('phone'))
                                    <small class="error">{{ $errors->first('phone') }}</small>
                                @endif
                            </label>
                        </fieldset>

                        <fieldset class="col-xs-8">
                            <label>
                                Email
                                <input type="text" name="email" value="{{ $contact->email }}">
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
                                        <option value="{{ $account->id }}"
                                                @if($account->id == $contact->account_id) selected @endif>{{ $account->name }}</option>
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
                                                @if($user->id == $contact->user_id) selected @endif>{{ $user->name }}</option>
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
                                <input type="text" name="street_name" value="{{ $contact->street_name }}">
                                @if($errors->has('street_name'))
                                    <small class="error">{{ $errors->first('street_name') }}</small>
                                @endif
                            </label>
                        </fieldset>

                        <fieldset class="col-xs-3">
                            <label>
                                Steet No.
                                <input type="text" name="street_number" value="{{ $contact->street_number }}">
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
                                <input type="text" name="zip" value="{{ $contact->zip }}">
                                @if($errors->has('zip'))
                                    <small class="error">{{ $errors->first('zip') }}</small>
                                @endif
                            </label>
                        </fieldset>

                        <fieldset class="col-xs-10">
                            <label>
                                City
                                <input type="text" name="city" value="{{ $contact->city }}">
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
                                <input type="text" name="country" value="{{ $contact->country }}">
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
                @include('app.contact.activity')
            </div>
        </section>
    </div>

@endsection