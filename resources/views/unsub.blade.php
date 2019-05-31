@extends('layouts.main')
@section('title', 'Unsubscribe')

@section('content')
    <div class="row">

        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form method="get" action="{{ route('unsubscribe') }}">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" class="form-control" type="text" name="email" placeholder="Your email address.."
                           value="@if(auth()->check()) {{ auth()->user()->email }} @endif">
                </div>
                <button type="submit" class="btn btn-primary">Unsubscribe</button>
            </form>
        </div>
    </div>

@endsection


