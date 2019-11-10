@extends('layouts.main')

@section('title', 'Blog')

@section('content')
    <div class="row">
       <div class="col-md-12">
            <form class="form-inline search-box" method="GET" action="{{ route('search.jobs') }}">
                <div class="form-group">
                    <label for="keyword"> <b> Job? </b> </label>
                    <input placeholder="Job title or keyword" id="keyword" class="form-control mr-2" type="text" name="keyword" value="{{ request()->input('keyword') }}">
                </div>

                <div class="form-group">
                    <label for="location"> <b>Location? </b> </label>
                    <input placeholder="Where do you want the job?" id="location" class="form-control" type="text" name="location" value="{{ request()->input('location') }}">
                </div>

                <br>
                <button class="btn btn-primary" type="submit"> Search </button>
            </form>

            @if(request()->get('title'))
                <h2><b>{{ ucfirst(request()->get('title')) }}</b></h1>
            @endif

            <br> <h2>Information center</h2>
            @foreach($blogposts as $eachBlogpost)
                <a href="{{ route('blogpost', ['slug' => $eachBlogpost->slug]) }}">{{ $eachBlogpost->title }}</a>
                <p>{{ $eachBlogpost->preview_text }}</p>
            @endforeach
       </div>
    </div>
@endsection