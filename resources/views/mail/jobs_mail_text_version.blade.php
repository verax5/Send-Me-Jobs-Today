<html>
    <body>
        <div>
            <div>
                <a href="{{ route('home') }}?keyword={{ $user->keyword }}&location={{ $user->location }}"><img alt="send me jobs today" src="{{ asset('logo.png')  }}"/>
                </a>
            </div>

            <div>
                <div>
                    <p>Job: <span>{{ ucfirst($user->keyword) }}</span></p>
                    <p >Location: <span>{{ $user->location == '' ? '-' : ucfirst($user->location) }}</span>
                    </p>
                </div>
            </div>

            <div>
                <p>
                    Jobs not relevant? <a href="{{ route('direct.login.view') }}?token={{ $user->direct_login_token }}">Improve</a>
                </p>

                <p>
                    Not interested? <a href="{{ route('unsubscribe') }}?email={{ $user->email }}">Unsubscribe me now!</a>
                </p>

                @if (!$singleFetch)
                    @foreach($jobs as $job)
                        <a href="{{ route('redirect') }}?user_id={{ $user->id }}&url={{ urlencode(str_replace('https://adview.online', '', $job->url)) }}"> {{ str_limit($job->title, 100) }}</a>
                        <p>{!! str_replace('...' , '', ucwords(strtolower($job->snippet))) !!}</p>
                        <ul>
                            @if($job->age)
                                <li>{{ $job->age }}</li> @endif
                            @if($job->salary)
                                <li>{{ $job->salary }}</li> @endif
                            @if($job->location)
                                <li>{{ $job->location }}</li> @endif
                            @if($job->job_type)
                                <li>{{ $job->job_type }}</li> @endif
                        </ul>
                        <hr>
                    @endforeach
                @else
                    <h1>We have found a <span>{{ ucfirst($user->keyword)  }}</span> job for you!
                    </h1>
                    <h1>
                        <hr>
                        <p>Would you be interested?</p>
                        <a href="{{ route('job.details') }}?keyword={{ $user->keyword }}">View Details..</a>
                    </h1>
                @endif
            </div>
        </div>
    </body>
</html>

