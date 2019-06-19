@extends('layouts.main')

@section('title', 'Search for a job')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="message_top">No time for search? <a href="{{ route('create.alert') }}">Receive automatic alerts everyday.</a></div>

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

            @if($jobs)
                @foreach($jobs->data as $job)
                    @php
                        $location = explode(',', $job->location);
                        $location = end($location);
                    @endphp

                    <div class="job-box">
                        <p class="url">
                            <a target="_blank" class="job_titles" href="{{ $job->url }}" onmousedown="{{ $job->onmousedown }}">{{ $job->title }}</a>
                            (<a href="{{ route('job.details') }}?keyword={{ urlencode($job->title) }}&location={{ $location }}">Details</a>)
                        </p>
                        <p class="salary"><i class="fas fa-coins"></i> {{ str_limit($job->salary, 50) }}
                        <i class="fas fa-map-marker-alt"></i> {{ $job->location }} </p>

                        <p class="snippet d-none d-sm-block">{!! str_replace('...', '', str_limit($job->snippet, 200)) !!}..</p>
                    </div>
                @endforeach
            @else
                <p class="alert alert-warning">We will be back shortly. You can email us at <b> jobs@sendmejobstoday.com </b> and let us know what jobs you're looking for and area.</p>

            @endif

            <div class="custom-pagination-box">
                <a class="custom-pagination" href="?keyword={{ request()->input('keyword') }}&location={{ request()->input('location') }}&category={{ request()->input('category') }}&page={{ $previousPage }}">Previous</a>
                <a class="custom-pagination" href="?keyword={{ request()->input('keyword') }}&location={{ request()->input('location') }}&category={{ request()->input('category') }}&page={{ $nextPage }}">Next</a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="search-in-sector-title">Search in Sector</div>
            <div class="search-in-sector-content">
                <a href="?category=Accountancy"><p>Accountancy</p></a>
                <a href="?category=Administration and Secretarial"><p>Admin</p></a>
                <a href="?category=Human Resources and Personnel"><p>HR</p></a>
                <a href="?category=Management and Consultancy"><p>Management</p></a>
                <a href="?category=Construction and Property"><p>Construction and Property</p></a>
                <a href="?category=Information Technology"><p>Information Technology</p></a>
                <a href="?category=Driving and Transport"><p>Driving</p></a>
                <a href="?category=Sales"><p>Sales</p></a>
                <a href="?category=Retail and Wholesale"><p>Retail</p></a>
                <a href="?category=Catering and Hospitality"><p>Catering and Hospitality</p></a>
                <a href="?category=Marketing, Advertising and PR"><p>Marketing/Advertising</p></a>
                <a href="?category=Social Care"><p>Social Care</p></a>
                <a href="?category=Graduates and Trainees"><p>Graduates and Trainees</p></a>
                <a href="?category=Education and Training"><p>Education and Training</p></a>
            </div>
        </div>
    </div>
@endsection