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
          <a class="nav-item nav-link" href=" {{ route('chat') }} "><i class="fas fa-crow"></i></a>
          <a class="nav-item nav-link" href=" {{ route('groups') }} "><i class="fas fa-users-cog"></i></a>
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

          <a class="nav-item nav-link" href="{{ route('notifications') }}">
            <i class="far fa-bell"></i>
            @if (Auth::user()->unreadnotifications()->count()>0)
            <span class="badge badge-danger text-center pt-1">{{ Auth::user()->unreadnotifications()->count() }}</span>
            @endif
          </a>
          @if (Auth::user()->role == 'admin')
          <a class="nav-item nav-link" href=" {{ route('admin.home') }} "><i class="fas fa-user-cog"></i></a>
          @endif
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
