@extends('layouts.main')

@section('title', 'Apply now')

@section('content')
	<div class="row text-center">
		<div class="col-md-12 mt-2 mb-2">
			<h2><b>{{ strtoupper(request()->get('title')) }}</b></h2>
		</div>
	</div>

	@foreach($jobDetails as $job)
	    <div class="row mb-4 text-center">
			<div class="col-md-12">
				{{ $job->title}} {{ $job->salary}}
				<div class="">
		   			<a onclick="countClick(); fbq('track', 'Purchase');" target="_blank" class="job_titles" href="{{ $job->url }}" onmousedown="{{ $job->onmousedown }}"><button style="padding-left:50px; padding-right:50px; background-color:#dd5800; font-size:20px; text-decoration: underline;" class="btn btn-info">Read Description..</button></a>
		   		</div>
			</div>	
		</div> <hr>
	@endforeach

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script>
        function countClick() { 
            jQuery.get('/count-click');      
        }
    </script>
@endsection