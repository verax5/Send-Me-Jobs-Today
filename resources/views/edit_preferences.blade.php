@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h2 class="enter-job-details-title">Edit Search Details</h2>

            @if(strlen(auth()->user()->confirmation_token) > 0)
                <form class="resend-confirmation-button" method="POST" action="{{ route('send.reconfirmation') }}">
                    <div class="alert alert-warning">Your account isn't confirmed.</div>
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary">Click here to Send another confirmation email</button>
                </form>
            @endif

            <form method="POST" action="{{ route('edit.preferences') }}">
                <div class="form-group">
                    <label for="keyword"><b>Keyword</b></label>
                    <input type="text" id="keyword" class="form-control" name="keyword" placeholder="Job title or a keyword.." value="{{ auth()->user()->keyword }}">
                </div>

                <div class="form-group">
                    <label for="location"><b>Location</b></label>
                    <input id="location" class="form-control" name="location" placeholder="Where do you want to work?" value="{{ auth()->user()->location }}">
                </div>

                {{ csrf_field() }}

                <div class="signup-button">
                    <button class="btn btn-primary" type="submit">Save!</button>
                </div>
            </form>
        </div>
    </div>

@endsection