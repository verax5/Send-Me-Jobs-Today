@extends('layouts.main')

@section('content')
    <div class="row">
        @if (! session()->has('signed_up'))
            <div class="col-md-3"></div>
            <div class="col-md-7">
                <h2 class="enter-job-details-title">What Job are you looking for and where?</h2>
                <form method="POST" action="{{ route('create.alert') }}">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="keywords"><b>What Job</b></label>
                            <select class="form-control" name="keyword" id="keywords">
                                <option disabled selected>Click here to choose..</option>
                                @foreach($jobList as $job)
                                    <option value="{{ $job->name }}">{{ $job->name }}</option>
                                @endforeach
                                <option value="">Other job?</option>
                            </select>
                        </div>

                        <div id="custom_keyword_section" class="form-group col-md-12" style="display: none;">
                            <label id="custom_keyword_label" for="custom_keyword"><b>Write job name..</b></label>
                            <input id="custom_keyword" type="text" class="form-control" name="custom_keyword"
                                   value="{{ old('custom_keyword') }}">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="location"><b>Which area?</b></label>
                        <input id="location" class="form-control" name="location" value="{{ old('location') }}">
                    </div>

                    <div class="form-group">
                        <label for="email"><b>Email</b></label>
                        <input id="email" class="form-control" name="email" value="{{ old('email') }}">
                    </div>

                    {{ csrf_field() }}

                    <div class="signup-button">
                        <button class="btn btn-primary" type="submit">SEARCH <i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        @else
            <div class="col-md-12 text-center mt-3">
                <h1 class="text-danger">Success! </h1>
                <h5>We will start sending you {{ session('keyword') }} jobs in {{ session('location') }} from
                    tomorrow!</h5>
                <h3> See
                    <a href="{{ route('search.jobs') }}?keyword={{ session('keyword') }}&location={{ session('location') }}">{{ session('keyword') }}
                        jobs in {{ session('location') }}</a></h3>
            </div>
        @endif
    </div>

    <script>
        $('#keywords').change(function () {
            if ($(this).val() == '') {
                $('#custom_keyword_section').show();
            } else {
                $('#custom_keyword_section').hide();
            }
        });
    </script>
@endsection