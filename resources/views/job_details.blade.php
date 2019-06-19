@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12 mt-3">
            <h5 class="job_details_title"> {{ $jobs[0]->title }} </h5>
            <p>{!! ucwords(str_replace('...', '', $jobs[0]->snippet)) !!}</p>

            <h6 style="font-weight:bold;">Additional info</h6>

            <ul class="text-left">
                <div class="additional_info">
                    @if($jobs[0]->location) <li> <i class="fas fa-map-marker"></i> {{ $jobs[0]->location }}</li> @endif
                    @if($jobs[0]->salary) <li> <i class="fas fa-coins"></i> {{ $jobs[0]->salary }}</li> @endif
                    @if($jobs[0]->job_type) <li> {{ $jobs[0]->job_type }}</li> @endif
                    @if($jobs[0]->company) <li> <i class="fas fa-building"></i> {{ $jobs[0]->company }}</li> @endif
                    @if($jobs[0]->age) <li> <i class="fas fa-clock"></i> {{ $jobs[0]->age }}</li> @endif
                </div>
            </ul>

            <div class="col-md-12 text-center mt-3">
                <a @if($medium != 'jbe') onmousedown="{{ $jobs[0]->onmousedown }}" @endif href="{{ $jobs[0]->url }}"><button class="btn btn-primary"><i class="fas fa-check-circle"></i> Apply Now!</button></a>
            </div>

            <ul class="list-group-flush">
                <b>Similar jobs</b>
                @foreach($jobs as $job)
                    @php $location = explode(',', $job->location); $location = end($location); @endphp
                    <li class="list-group-item text-left">
                        <a @if(request()->get('search_type') != 'email') onmousedown="{{ $job->onmousedown }}" @endif href="{{ $job->url }}">{{ $job->title }}</a>
                        <span style="float:right">{{ $location }}</span>
                    </li>
                @endforeach
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
        font-size:15px;
    }

    .list-group-item {
        padding:0 !important;
    }

</style>