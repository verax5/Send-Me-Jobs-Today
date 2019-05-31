@extends('layouts.main')

@section('title', 'Set Password')

@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form method="POST" action="{{ route('normal.password.set') }}">
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                {{ csrf_field() }}
                <button class="btn btn-primary">Set Password</button>
            </form>
        </div>
    </div>

@endsection