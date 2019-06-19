<html>
<body>
<div style="width:600px; margin:auto;">
    <img width="1" height="1" border="0" style="border: none; padding: 0;"
         alt="tracking" src="https://adview.online/api/v1/pub-tracking/jbe/1145/space.gif">

    <div style="text-align:center; margin-bottom:20px;">
        <a href="{{ route('home') }}?keyword={{ $user->keyword }}&location={{ $user->location }}"><img
                    alt="send me jobs today"
                    style="width:300px;margin:auto;" src="{{ asset('logo.png')  }}"/>
        </a>
    </div>

    <div style="background-color:#0070f7;padding:10px; color:white; overflow:auto">
        <div style="float:left">
            <p style="padding:0; margin:0; display:inline; font-size:14px;">Job: <span
                        style="font-weight:bold; font-style: italic;">{{ ucfirst($user->keyword) }}</span></p>
            <p style="padding:0; margin:0; display:inline; font-size:14px;">Location: <span
                        style="font-weight:bold; font-style:italic;">{{ $user->location == '' ? '-' : ucfirst($user->location) }}</span>
            </p>
        </div>
    </div>

    <div style="margin:auto;">
        <p style="text-align: right; font-size:14px;">
            Jobs not relevant? <a style="text-align: right;"
                                  href="{{ route('direct.login.view') }}?token={{ $user->direct_login_token }}">Improve</a>
        </p>

        <p style="text-align:right; font-size:14px;">
            Not interested? <a href="{{ route('unsubscribe') }}?email={{ $user->email }}">Unsubscribe me now!</a>
        </p>

        @if (!$singleFetch)
            @foreach($jobs as $job)
                <a style="font-size:15px; background-color: #e4ebff; display: inline-block; width: 100%; padding: 10px;"
                   href="{{ route('redirect') }}?user_id={{ $user->id }}&url={{ urlencode(str_replace('https://adview.online', '', $job->url)) }}"> {{ str_limit($job->title, 100) }}</a>
                <p style="font-size:14px">{!! str_replace('...' , '', ucwords(strtolower($job->snippet))) !!}</p>
                <ul style="font-size:14px">
                    @if($job->age)
                        <li>{{ $job->age }}</li> @endif
                    @if($job->salary)
                        <li>{{ $job->salary }}</li> @endif
                    @if($job->location)
                        <li>{{ $job->location }}</li> @endif
                    @if($job->job_type)
                        <li>{{ $job->job_type }}</li> @endif
                </ul>
                <hr style="background-color:lightgray; height:1px; border:0;">
            @endforeach
        @else
            <h1 style="text-align: center;">We have found a <span
                        style="color:darkorange; font-style: italic;">{{ ucfirst(stripslashes($user->keyword))  }}</span> job for you!
            </h1>
            <h1 style="text-align:center">
                <hr>
                <p style="font-size:20px; margin-top:30px;">Are you interested?</p>
                <a href="{{ route('job.details') }}?keyword={{ $user->keyword }}&location={{ $user->location }}&search_type=email&user_id={{ $user->id }}">View Details..</a>
            </h1>
        @endif
    </div>
</div>
</body>
</html>

