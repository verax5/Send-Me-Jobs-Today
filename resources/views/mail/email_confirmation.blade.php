<div class="container" style="width:600px; margin:auto;">
    <div style="text-align:center; margin-bottom:20px;">
        <a href="{{ route('home') }}?keyword={{ $user->keyword }}&location={{ $user->location }}"><img style="width:350px;margin:auto;" src="{{ asset('logo.png')  }}"/>
        </a>
    </div>

    <div class="jobs" style="margin:auto;">
        <p>Hi {{ $user->name }}, your daily job alerts are almost active! Now just confirm your account. </p>

        <p>
            <a style="text-decoration:none" href="{{ route('confirm', ['token' => $user->confirmation_token]) }}">
                <span style="background-color:#0070f7;
                text-align:center;
                 display:block;
                 padding:50px;
                 color:white;
                 font-weight:bold;
                 font-size:20px;
                 margin-top:20px;">Confirm my Account</span>
            </a>
        </p>

        <p style="color:grey;">If you can't see the button above then just <a href="{{ route('confirm', ['token' => $user->confirmation_token]) }}">here</a>

    </div>

</div>
