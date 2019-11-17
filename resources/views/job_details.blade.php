@extends('layouts.main')

@section('title', 'Apply now')

@section('content')

    <div class="row">
    	<div class="col-md-12">
    		<h2 class="text-center">{{request()->get('title')}}</h2> {{--Location: {{request()->location}} --}}
    			
    			{{-- <p>As a {{request()->title}} you will be working on various projects which includes working on greenfield projects aswell as legacy. You're also expected to have good understanding of MySQL aswell as HTML/CSS and Javascript along with good communication skills.</p> 
    		--}}

    		{{-- <p>{!! $jobDetails->snippet !!}</p> --}}
    		<br>
    		<div class="text-center">
       			<a onclick="countClick();" target="_blank" class="job_titles" href="{{ $jobDetails->url }}" onmousedown="{{ $jobDetails->onmousedown }}"><button style="padding-left:50px; padding-right:50px; background-color:#dd5800; font-size:20px; text-decoration: underline;" class="btn btn-info">Read Description..</button></a>
       		</div>
    	</div>

    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script>
        function countClick() { 
            jQuery.get('/count-click');      
        }
    </script>
@endsection