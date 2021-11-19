<nav class="navbar navbar-expand-md navbar-dark bg-steel fixed-top">
    <div class="container">
      <a class="navbar-brand mr-4" href=" {{ route('post.home') }} ">Pigeon</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarToggle">
        <div class="navbar-nav mr-auto">
          <a class="nav-item nav-link" href=" {{ route('post.home') }} ">Home</a>
          <a class="nav-item nav-link" href="#">About</a>

          <a class="navbar-brand pl-5" href=" {{route('anonymous.index')}} ">
            <img src="/media/anon.png" width="30" height="30" class="rounded-circle d-inline-block align-top" alt="Anonymous">
          </a>
          <form class="form-inline my-2 my-lg-0 pl-5" action="{{ route('search') }}" method="GET">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-secondary" type="submit">Search</button>
          </form>
          
          
        </div>
        <!-- Navbar Right Side -->
        <div class="navbar-nav">
          @if (Auth::check())
          <a class="nav-item nav-link" href=" {{ route('profiles.show',$user->id??'') }} ">Profile</a>
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