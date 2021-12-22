<nav class="navbar navbar-expand-lg navbar-dark bg-danger h-25 mb-2 shadow-sm">
    <div class="container">
      <div style="width:40px; height: 40px; background-image: url({{ asset('/images/logo.png') }}); background-position: center; background-size: cover;" class="rounded-circle"></div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('users_details')) ? 'active' : '' }}" aria-current="page" href="/users_details">Home</a>
          </li>
          @if (Auth::user()->isUser)
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('show_notification')) ? 'active' : '' }}" aria-current="page" href="/show_notification">Notification</a>
            </li>
          @endif
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('users_details/*')) ? 'active' : '' }}" href="/users_details/{{ Auth::id() }}/edit">Details</a>
          </li>
          @if (!(Auth::user()->isUser))
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('offer')) ? 'active' : '' }}" aria-current="page" href="/offer">Offers</a>
          </li>
        @endif
        
          @guest
          @if (Route::has('login'))
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
          @endif

          @if (Route::has('register'))
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
          @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
        </ul>
      </div>
    </div>
  </nav>
