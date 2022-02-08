<!DOCTYPE html>
<html>
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    @toastr_css
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <title>Pigeon</title>
</head>



<body>
    <header class="site-header">
      {{-- Nevbar starts --}}
        @include('layout.nevbar')
      {{-- Nevbar ends --}}
    </header>



    <main role="main" class="container">
      <div class="row">
        <div class="col-md-8">
          {{-- Body content starts --}}
            @yield('content')
          {{-- Body Content ends --}}
        </div>



        <div class="col-md-4">
          {{-- Sidebar starts --}}
            @yield('sidebar')
            {{-- @include('layout.sider_nev') --}}
          {{-- Sidebar ends --}}
        </div>
      </div>
    </main>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-61fde7493d91fa1c"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    {{-- toastr js file above </body> --}}
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    @jquery
    @toastr_js
    @toastr_render
    <script src="{{ asset('js/toastr.min.js') }}" type="text/javascript"></script>

{{-- Toastr Notifications Starts --}}

    <script type="text/javascript">
      @if (Session::has('comment'))

          toastr.options.positionClass = 'toast-bottom-right';
          toastr.success("{{ Session::get('comment') }}");
      @endif
    </script>

    <script type="text/javascript">
      @if (Session::has('post_created'))

          toastr.options.positionClass = 'toast-bottom-right';
          toastr.success("{{ Session::get('post_created') }}");
      @endif
    </script>

    <script type="text/javascript">
      @if (Session::has('post_updated'))

          toastr.options.positionClass = 'toast-bottom-right';
          toastr.success("{{ Session::get('post_updated') }}");
      @endif
    </script>

    <script type="text/javascript">
      @if (Session::has('post_deleted'))

          toastr.options.positionClass = 'toast-bottom-right';
          toastr.error("{{ Session::get('post_deleted') }}");
      @endif
    </script>

    {{-- Toast For Report Starts--}}
    <script type="text/javascript">
      @if (Session::has('report'))
          toastr.options.positionClass = 'toast-bottom-right';
          toastr.info("{{ Session::get('report') }}");

      @elseif (Session::has('own_post'))
          toastr.options.positionClass = 'toast-bottom-right';
          toastr.error("{{ Session::get('own_post') }}");

      @elseif (Session::has('alreay_reported'))
          toastr.options.positionClass = 'toast-bottom-right';
          toastr.error("{{ Session::get('alreay_reported') }}");
      @endif
    </script>
    {{-- Toast For Report Ends --}}

{{-- Toastr Notifications Ends --}}
</body>
</html>