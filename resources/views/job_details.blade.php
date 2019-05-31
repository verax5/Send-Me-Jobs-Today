@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12 mt-5">
            <h3 class="job_details_title"> <p>Job Available: </p>{{ $job->title }} </h3>
            <p>{!! ucwords(str_replace('...', '', $job->snippet)) !!}</p>

            <div class="col-md-12 text-center mt-5">
                <a onmousedown="{{ $job->onmousedown }}" href="{{ $job->url }}"><button class="btn btn-primary btn-lg"><i class="fas fa-check-circle"></i> Apply Now!</button></a>
            </div>

            <hr>
            <h6 style="font-weight:bold;">Additional info</h6>

            <ul class="text-left">
                <div class="additional_info">
                    @if($job->location) <li> <i class="fas fa-map-marker"></i> {{ $job->location }}</li> @endif
                    @if($job->salary) <li> <i class="fas fa-coins"></i> {{ $job->salary }}</li> @endif
                    @if($job->job_type) <li> {{ $job->job_type }}</li> @endif
                    @if($job->company) <li> <i class="fas fa-building"></i> {{ $job->company }}</li> @endif
                    @if($job->age) <li> <i class="fas fa-clock"></i> {{ $job->age }}</li> @endif
                </div>
            </ul>
        </div>
    </div>
@endsection

<style>
    .job_details_title {
        font-weight:bold;
        color:blue;
    }

    .job_details_title p {
        color:red;
        text-transform: uppercase;
        margin-bottom:10px;
        font-size:20px;
    }

    ul {
        list-style: none;
    }

    .additional_info {
        color:#333;
    }

</style>