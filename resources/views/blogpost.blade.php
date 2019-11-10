@extends('layouts.main')

@section('title', $blogpost->title)

@section('content')
    <div class="row">
        <div class="col-md-7">
            <br> <h5>{{ $blogpost->title }}</h5> <br>
            <p class="text-center"><img width="200px" src="https://primark.a.bigcontent.io/v1/static/logo-primark-for-website"></p>
            <p><a href="{{ route('search.jobs') }}?keyword={{$blogpost->blogpost_keyword}}"><button class="btn btn-info">View {{ $blogpost->blogpost_keyword }} Jobs</button></a></p>
            {!! $blogpost->blogpost !!}
        </div>

        <div class="col-md-4">
            <h2>Related jobs</h2>
            @if($jobs)
                @foreach($jobs->data as $job)
                    @php
                        $location = explode(',', $job->location);
                        $location = end($location);
                    @endphp

                    <div class="job-box">
                        <p class="url">
                            <a style="font-size:20px;" onclick="countClick();" target="_blank" class="job_titles" href="{{ $job->url }}" onmousedown="{{ $job->onmousedown }}">{{ $job->title }}</a>

                            @if($job->salary)
                                <span style="font-style: italic; font-size:15px;" class="salary"><i class="fas fa-coins"></i><i>{{ str_limit($job->salary, 100) }}</i></span> 
                            @endif
                        </p>

                        <span>{{ $job->location }} </span>

                        <p class="snippet d-sm-block">{!! str_replace('...', '', str_limit($job->snippet, 500)) !!}..</p>

                        <a onclick="countClick();" target="_blank" class="job_titles" href="{{ $job->url }}" onmousedown="{{ $job->onmousedown }}">More Info..</a>
                    </div>
                @endforeach
            @else
                <p class="alert alert-warning">We will be back shortly. You can email us at <b> jobs@sendmejobstoday.com </b> and let us know what jobs you're looking for and area.</p>
            @endif
        </div>
    </div>
@endsection