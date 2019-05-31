@extends('layouts.main')
@section('title', 'login')

@section('content')
    <div class="row">

        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h6 class="login-or-signup">Don't have account? <a href="{{ route('create.alert') }}"> SIGNUP HERE</a> </h6>
            <h5 class="login-or-signup text-danger">Set a password <a href="{{ route('normal.password.set.ask.email') }}"> Here</a> </h5>

            <form method="POST" action="{{ route('basic.login') }}">
                <h2 class="login-title">Login</h2>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" class="form-control" name="email" placeholder="example@gmail.com">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control" name="password" placeholder="Your password..">
                </div>

                {{ csrf_field() }}
                <button class="btn btn-primary" type="submit">Login</button>
            </form>
        </div>
    </div>

@endsection