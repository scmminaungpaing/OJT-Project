<nav class="navbar navbar-expand-lg navbar-light bg-light" style="box-shadow: 5px 10px 30px rgba(0,0,0,0.1);">
  <div class="container">
      <h5><a class="navbar-brand" href="{{ route('frontend#home') }}"><i class="fas fa-home"></i> HOME</a></h5>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        @if (Auth::check())
          @if (Auth::user()->role->id != 1)
            <a href="{{route('home')}}" class="nav-link mr-1"><b><i class="fas fa-user"></i> {{ Str::ucfirst(Auth::user()->name) }}</b></a>

            <a href="{{ route('logout') }}" class="nav-link btn btn-primary text-white"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"><i class="fa fa-power-off mr-1"></i> Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          @else
              <a href="{{route('admin#home')}}" class="nav-link mr-1"><b><i class="fas fa-user"></i> {{ Str::ucfirst(Auth::user()->name) }}</b></a>

              <a href="{{ route('logout') }}" class="nav-link btn btn-primary text-white"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();"><i class="fa fa-power-off mr-1"></i> Logout
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
          @endif
        @else
        <li class="nav-item">
          <a class="nav-link btn btn-primary btn-sm" href="{{ route('login') }}"><i class="fas fa-user mr-1"></i> Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-primary btn-sm ml-3" href="{{ route('register') }}"><i class="fas fa-file-signature mr-1"></i> Register</a>
        </li>
        @endif
      </ul>
    </div>
  </div>
</nav>
