@extends('layouts.app')

@section('content')

    @if(Session::has('alert-success'))
        <div class="alert success">
            {{ Session::get('alert-success') }}
        </div>
    @endif

    <header>
        <h1>Lead conversion</h1>
    </header>

    <form method="POST" action="{{ route('app.lead.convert', $lead->id) }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-12">
                <div class="panel">
                    <header>
                        <h1>Opportunity</h1>
                    </header>

                    <div class="row">
                        <fieldset class="col-xs-10">
                            <label>
                                Name*
                                <input type="text" name="opportunity_name" value="{{ old('opportunity_name') }}">
                                @if($errors->has('opportunity_name'))
                                    <small class="error">{{ $errors->first('opportunity_name') }}</small>
                                @endif
                            </label>
                        </fieldset>

                        <fieldset class="col-xs-2">
                            <label>
                                Amount
                                <input type="text" name="opportunity_amount" value="{{ old('opportunity_amount') }}">
                                @if($errors->has('opportunity_amount'))
                                    <small class="error">{{ $errors->first('opportunity_amount') }}</small>
                                @endif
                            </label>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <div class="panel">
                    <header>
                        <h1>Account</h1>
                    </header>

                    <div class="row">
                        <fieldset class="col-xs-8">
                            <label>
                                Name*
                                <input type="text" name="account_name"
                                       value="{{ old('account_name', $lead->company) }}">
                                @if($errors->has('account_name'))
                                    <small class="error">{{ $errors->first('account_name') }}</small>
                                @endif
                            </label>
                        </fieldset>

                        <fieldset class="col-xs-4">
                            <label>
                                CVR
                                <input type="text" name="account_cvr" value="{{ old('account_cvr') }}">
                                @if($errors->has('account_cvr'))
                                    <small class="error">{{ $errors->first('account_cvr') }}</small>
                                @endif
                            </label>
                        </fieldset>
                    </div>

                    <div class="row">
                        <fieldset class="col-xs-4">
                            <label>
                                Phone
                                <input type="text" name="account_phone" value="{{ old('account_phone') }}">
                                @if($errors->has('account_phone'))
                                    <small class="error">{{ $errors->first('account_phone') }}</small>
                                @endif
                            </label>
                        </fieldset>

                        <fieldset class="col-xs-8">
                            <label>
                                Email
                                <input type="text" name="account_email" value="{{ old('account_email') }}">
                                @if($errors->has('account_email'))
                                    <small class="error">{{ $errors->first('account_email') }}</small>
                                @endif
                            </label>
                        </fieldset>
                    </div>

                    <div class="row">
                        <fieldset class="col-xs-12">
                            <label>
                                Website
                                <input type="text" name="account_website" value="{{ old('account_website') }}">
                                @if($errors->has('account_website'))
                                    <small class="error">{{ $errors->first('account_website') }}</small>
                                @endif
                            </label>
                        </fieldset>
                    </div>

                    <br>

                    <div class="row">
                        <fieldset class="col-xs-9">
                            <label>
                                Street Name
                                <input type="text" name="account_street_name" value="{{ old('account_street_name') }}">
                                @if($errors->has('account_street_name'))
                                    <small class="error">{{ $errors->first('account_street_name') }}</small>
                                @endif
                            </label>
                        </fieldset>

                        <fieldset class="col-xs-3">
                            <label>
                                Steet No.
                                <input type="text" name="account_street_number"
                                       value="{{ old('account_street_number') }}">
                                @if($errors->has('account_street_number'))
                                    <small class="error">{{ $errors->first('account_street_number') }}</small>
                                @endif
                            </label>
                        </fieldset>
                    </div>

                    <div class="row">
                        <fieldset class="col-xs-3">
                            <label>
                                Zip
                                <input type="text" name="account_zip" value="{{ old('account_zip') }}">
                                @if($errors->has('account_zip'))
                                    <small class="error">{{ $errors->first('account_zip') }}</small>
                                @endif
                            </label>
                        </fieldset>

                        <fieldset class="col-xs-9">
                            <label>
                                City
                                <input type="text" name="account_city" value="{{ old('account_city') }}">
                                @if($errors->has('city'))
                                    <small class="error">{{ $errors->first('account_city') }}</small>
                                @endif
                            </label>
                        </fieldset>
                    </div>

                    <div class="row">
                        <fieldset class="col-xs-12">
                            <label>
                                Country
                                <input type="text" name="account_country" value="{{ old('account_country') }}">
                                @if($errors->has('account_country'))
                                    <small class="error">{{ $errors->first('account_country') }}</small>
                                @endif
                            </label>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-xs-6">
                <div class="panel">
                    <header>
                        <h1>Contact</h1>
                    </header>

                    <div class="row">
                        <fieldset class="col-xs-8">
                            <label>
                                Name*
                                <input type="text" name="contact_name" value="{{ old('contact_name', $lead->name) }}">
                                @if($errors->has('contact_name'))
                                    <small class="error">{{ $errors->first('contact_name') }}</small>
                                @endif
                            </label>
                        </fieldset>

                        <fieldset class="col-xs-4">
                            <label>
                                Title
                                <input type="text" name="contact_title"
                                       value="{{ old('contact_title', $lead->title) }}">
                                @if($errors->has('contact_title'))
                                    <small class="error">{{ $errors->first('contact_title') }}</small>
                                @endif
                            </label>
                        </fieldset>
                    </div>

                    <div class="row">
                        <fieldset class="col-xs-4">
                            <label>
                                Phone
                                <input type="text" name="contact_phone"
                                       value="{{ old('contact_phone', $lead->phone) }}">
                                @if($errors->has('contact_phone'))
                                    <small class="error">{{ $errors->first('contact_phone') }}</small>
                                @endif
                            </label>
                        </fieldset>

                        <fieldset class="col-xs-8">
                            <label>
                                Email
                                <input type="text" name="contact_email"
                                       value="{{ old('contact_email', $lead->email) }}">
                                @if($errors->has('contact_email'))
                                    <small class="error">{{ $errors->first('contact_email') }}</small>
                                @endif
                            </label>
                        </fieldset>
                    </div>

                    <br>

                    <div class="row">
                        <fieldset class="col-xs-9">
                            <label>
                                Street Name
                                <input type="text" name="contact_street_name"
                                       value="{{ old('contact_street_name', $lead->street_name) }}">
                                @if($errors->has('contact_street_name'))
                                    <small class="error">{{ $errors->first('contact_street_name') }}</small>
                                @endif
                            </label>
                        </fieldset>

                        <fieldset class="col-xs-3">
                            <label>
                                Steet No.
                                <input type="text" name="contact_street_number"
                                       value="{{ old('contact_street_number', $lead->street_number) }}">
                                @if($errors->has('contact_street_number'))
                                    <small class="error">{{ $errors->first('contact_street_number') }}</small>
                                @endif
                            </label>
                        </fieldset>
                    </div>

                    <div class="row">
                        <fieldset class="col-xs-3">
                            <label>
                                Zip
                                <input type="text" name="contact_zip" value="{{ old('contact_zip', $lead->zip) }}">
                                @if($errors->has('contact_zip'))
                                    <small class="error">{{ $errors->first('contact_zip') }}</small>
                                @endif
                            </label>
                        </fieldset>

                        <fieldset class="col-xs-9">
                            <label>
                                City
                                <input type="text" name="contact_city" value="{{ old('contact_city', $lead->city) }}">
                                @if($errors->has('contact_city'))
                                    <small class="error">{{ $errors->first('contact_city') }}</small>
                                @endif
                            </label>
                        </fieldset>
                    </div>

                    <div class="row">
                        <fieldset class="col-xs-12">
                            <label>
                                Country
                                <input type="text" name="contact_country"
                                       value="{{ old('contact_country', $lead->country) }}">
                                @if($errors->has('contact_country'))
                                    <small class="error">{{ $errors->first('contact_country') }}</small>
                                @endif
                            </label>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <button class="submit">Convert</button>
            </div>
        </div>

    </form>

@endsection