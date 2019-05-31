<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>

            @if(! auth()->check())
                <li class="nav-item">
                    <a class="nav-link receive-job-alert-link" href="{{ route('create.alert') }}">Receive jobs in Email</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('basic.login') }}">Login/Set Password</a>
                </li>
            @endif

            <li class="nav-item">
                <a class="nav-link" href="{{ route('contact') }}">Contact</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('unsubForm') }}">Unsubscribe</a>
            </li>

            @if(auth()->check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('edit.preferences') }}">Edit Preferences</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </li>
            @endif
        </ul>
    </div>
</nav>