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
                    <a href="{{ route('app.ticket.show', $ticket->id) }}" class="button">Back</a>
                    <form method="POST"
                          action="{{ route($ticket->active ? 'app.ticket.destroy' : 'app.ticket.restore', $ticket->id) }}">
                        {{ csrf_field() }}
                        <button type="submit">{{ $ticket->active ? 'Destroy' : 'Restore' }}</button>
                    </form>
                </header>

                <form method="POST" action="{{ route('app.ticket.update', $ticket->id) }}">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}

                    <div class="row">
                        <fieldset class="col-xs-12">
                            <label>
                                Subject*
                                <input type="text" name="subject" value="{{ $ticket->subject }}">
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
                                <textarea name="description">{{ $ticket->description }}</textarea>
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
                                        <option value="{{ $account->id }}"
                                                @if($account->id == $ticket->account_id) selected @endif>{{ $account->name }}</option>
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
                                        <option value="{{ $contact->id }}"
                                                @if($contact->id == $ticket->contact_id) selected @endif>{{ $contact->name }}</option>
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
                                        <option value="{{ $user->id }}"
                                                @if($user->id == $ticket->user_id) selected @endif>{{ $user->name }}</option>
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
        </section>

        <section class="col-xs-4">
            <div class="panel activities">
                <header>
                    <h1>Activities</h1>
                </header>
                @include('app.ticket.activity')
            </div>
        </section>
    </div>

@endsection