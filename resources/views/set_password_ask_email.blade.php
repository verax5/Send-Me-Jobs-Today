@extends('layouts.main')

@section('title', 'Set Password')

@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>

                {{ csrf_field() }}
                <button class="btn btn-primary">Send password</button>
            </form>
        </div>
    </div>

@endsection