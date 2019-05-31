@extends('layouts.main')

@section('title', 'Contact us')

@section('content')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

        <form method="POST" action="{{ route('contact') }}">
                <div class="form-group">
                    <label for="name"><b>Name</b></label>
                    <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Your name..">
                </div>

                <div class="form-group">
                    <label for="email"><b>Email address</b></label>
                    <input id="email" class="form-control" type="text" name="email" value="{{ old('email') }}" placeholder="Email we should contact you on..">
                </div>

                <div class="form-group">
                    <label for="message"><b>Message</b></label>
                    <textarea id="message" class="form-control" name="message" rows="5" placeholder="How can we help you?">{{ old('message') }}</textarea>
                </div>

                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>

    </div>
@endsection