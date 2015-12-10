@extends('app.main')

@section('content')

    <section>
        <a href="{{ route('app.account.index') }}">Back</a>

        <h1>Create Account</h1>

        <form action="{{ route('app.account.create') }}">
            {{ csrf_field() }}
            <div class="errors">

            </div>
            <div>
                <label>
                    Name
                    <input name="name" type="text">
                </label>
            </div>
            <div>
                <label>
                    Street Name
                    <input name="street_name" type="text">
                </label>
            </div>
            <div>
                <label>
                    Street Number
                    <input name="street_number" type="text">
                </label>
            </div>
            <div>
                <label>
                    Zip
                    <input name="zip" type="text">
                </label>
            </div>
            <div>
                <label>
                    City
                    <input name="city" type="text">
                </label>
            </div>
            <div>
                <label>
                    Country
                    <input name="country" type="text">
                </label>
            </div>
            <div>
                <label>
                    CVR
                    <input name="cvr" type="text">
                </label>
            </div>
            <div>
                <label>
                    Phone
                    <input name="phone" type="text">
                </label>
            </div>
            <div>
                <label>
                    Email
                    <input name="email" type="text">
                </label>
            </div>
           <div>
               <label>
                   Website
                   <input name="website" type="text">
               </label>
           </div>
            <div>
                <button type="submit">Create</button>
            </div>
        </form>
    </section>

@endsection