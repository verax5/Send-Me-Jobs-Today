@extends('layouts.main')

@section('content')
    <div class="row">

        <div class="col-md-2"></div>
        <div class="col-md-6">

            <form method="POST" action="{{ route('direct.login') }}">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" name="password" class="form-control" type="password">
                </div>
                <button type="submit" class="btn btn-primary">Set Password & Login</button>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection