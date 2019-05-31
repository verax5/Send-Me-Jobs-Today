@extends('layouts.custom_pages')

@section('title',  $data->page_title )

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="main-heading">
                {{ $data->page_main_heading }}
                <p class="sub-heading">{{ $data->page_subheading }}</p>
            </h1>

            <div class="header-image">
                <img src="{{ $data->image }}">
            </div>

            <div class="body-title">
                {{ $data->body_title }}
            </div>
            <p class="body-title-content"> {{ $data->page_body  }}</p>

            <h1 class="form-title">{{ $data->form_title }}</h1>
            <form method="POST" action="{{ route('create.alert') }}">
                <div class="form-group">
                    <label for="keyword"><b>Name</b></label>
                    <input id="keyword" class="form-control" name="name" placeholder="Friendly name?" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label class="d-none" for="keyword"><b>Keyword</b></label>
                    <input id="keyword" class="form-control" name="keyword" placeholder="Job title or a keyword.." value="{{ $data->keyword }}" type="hidden">
                </div>

                <div class="form-group">
                    <label class="d-none" for="location"><b>Location</b></label>
                    <input id="location" class="form-control" name="location" placeholder="Where do you want to work?" value="united kingdom" type="hidden">
                </div>

                <div class="form-group">
                    <label for="email"><b>Email</b></label>
                    <input id="email" class="form-control" name="email" placeholder="Your email address.." value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="password"><b>Password</b></label>
                    <input type="password" id="password" class="form-control" name="password" placeholder="Your password..">
                </div>

                {{ csrf_field() }}

                <div class="signup-button">
                    <button class="btn btn-primary" type="submit">Sign me up!</button>
                </div>
            </form>
        </div>
    </div>
    <p> {{ $data->page_under_body }}</p>
@endsection