<div class="c-container-navbar">
    <nav class="l-navbar">
        <div class="l-navbar_logo">
            <a href="/">
                <span><b>Laravel Instagram Clone</b></span>
            </a>            
        </div>
        <ul class="l-navbar-links">
            <!-- Authentication Links -->
            @guest
                <li class="l-navbar-item">
                    <a class="l-navbar-link btn btn-primary" href="{{ route('login') }}">{{ __('Log In') }}</a>
                </li>
                <li class="l-navbar-item">
                    <a class="l-navbar-link btn btn-register" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @else
                <li class="l-navbar-item">
                    <span class="l-navbar-link">
                        {{ Auth::user()->name }}
                    </span>
                </li>
                <li class="l-navbar-item">
                    <span class="l-navbar-link">
                        <a class="link" href="/profile/{{ Auth::user()->id }}">
                        Profile
                        </a>
                    </span>
                </li>
                <li class="l-navbar-item">
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>     
            @endguest
        </ul>
    </nav>
</div>