<div class="c-container-navbar">
    <nav class="l-navbar">
        <div class="l-navbar_logo">
            <a href="/">
                <span><b>Laravel Instagram Clone</b></span>
            </a>            
        </div>
        @guest
        <ul class="l-navbar-links l-navbar-guest">
            <!-- Authentication Links -->
            <li class="l-navbar-item">
                <a class="l-navbar-link btn btn-primary" href="{{ route('login') }}">{{ __('Log In') }}</a>
            </li>
            <li class="l-navbar-item">
                <a class="l-navbar-link btn btn-register" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        </ul>
        @else
        <ul class="l-navbar-auth">                   
            <li class="l-navbar-item">
                <a href="{{ route('index') }}"><span class="icon-home"></span></a>
            </li>       
            <li class="l-navbar-item">
                <span class="icon-search"></span>
            </li>       
            <li class="l-navbar-item">
                <a href="/p/create"><span class="icon-add"></span></a>
            </li>   
            <li class="l-navbar-item">
                <a href="/profile/{{ auth()->user()->id }}"><span class="icon-user"></span></a>
            </li>       
            <li class="l-navbar-item">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <span class="icon-exit"></span>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </a>
            </li>  
            {{-- <li class="l-navbar-item">
                <a class="btn btn-primary" href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>   --}}
        </ul>
        @endguest

    </nav>
</div>