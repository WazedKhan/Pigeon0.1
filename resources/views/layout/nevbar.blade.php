<nav class="navbar navbar-expand-md navbar-dark bg-steel fixed-top">
    <div class="container">
      <a class="navbar-brand mr-4" href=" {{ route('home') }} ">Pigeon</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarToggle">
        <div class="navbar-nav mr-auto">
          <a class="nav-item nav-link" href=" {{ route('post.home') }} ">Home</a>

          @if (Auth::check())
          <a class="nav-item nav-link align-items-center " href=" {{ route('suggest') }} "><i class="fas fa-person-booth "> Find Buddy's</i></a>
          <a class="nav-item nav-link" href=" {{ route('chat') }} "><i class="fas fa-crow">Chat</i></a>
          @endif

          <form class="form-inline my-2 my-lg-0 pl-5" action="{{ route('search') }}" method="GET">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
            <button class="btn btn-secondary" type="submit">Search</button>
          </form>


        </div>
        <!-- Navbar Right Side -->
        <div class="navbar-nav">
          @if (Auth::check())
          <a class="nav-item nav-link navbar-brand pl-0 pr-0" href=" {{ route('profile.show',Auth::user()->id??'') }} ">
            <img src="{{ Auth::user()->profile->profileImage()}}" width="30" height="30" class="rounded-circle d-inline-block align-top" alt="Profile Photo">
            <small>{{Auth::user()->name}}</small>
          </a>

          <a class="nav-item nav-link" href="#">
            <svg xmlns="http://www.w3.org/2000/svg"  width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
            </svg>
            <span class="badge badge-light text-center pt-1">4</span>
          </a>

          <a class="nav-item nav-link" href=" {{ route('post.create') }} ">Create New Post</a>
          <a class="nav-item nav-link" href="{{route('logout')}}">Log Out</a>
          @else
          <a class="nav-item nav-link" href="{{route('login')}}">Login</a>
          <a class="nav-item nav-link" href=" {{ route('register') }} ">Register</a>
          @endif
        </div>
      </div>
    </div>
  </nav>
