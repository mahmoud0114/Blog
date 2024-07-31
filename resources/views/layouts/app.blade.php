<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  <!-- blog links -->
  <link rel="preload" href="https://fonts.gstatic.com/s/opensans/v18/mem8YaGs126MiZpBA-UFWJ0bbck.woff2" style="font-display: optional;">

  <link rel="stylesheet" href="{{ asset ('plugins/bootstrap/bootstrap.min.css') }}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:600%7cOpen&#43;Sans&amp;display=swap" media="screen">

  <link rel="stylesheet" href="{{ asset ('plugins/themify-icons/themify-icons.css') }}">

  <link rel="stylesheet" href="{{ asset ('plugins/slick/slick.css') }}">

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="{{ asset ('css/style.css') }}">

  <!--Favicon-->
  <link rel="shortcut icon" href="{{ asset ('images/favicon.png') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset ('images/favicon.png') }}" type="image/x-icon">


</head>
<body>
  <div id="app">
    <header class="sticky-top bg-white border-bottom border-default">
      <div class="container">

        <nav class="navbar navbar-expand-lg navbar-light bg-white">
          <a class="navbar-brand" href="{{ url('/') }}">
            <img class="img-fluid" width="150px" src="{{ asset('images/logo.png')}}" alt="LogBook">
          </a>
          <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navigation">
            <i class="ti-menu"></i>
          </button>

          <div class="collapse navbar-collapse text-center" id="navigation">
            <ul class="navbar-nav ml-auto">

              <!-- Authentication Links -->

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
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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

              <!--    Users   -->
              @can('admin-control')
              <li class="nav-item">
                <a class="nav-link" href="{{route ('user.index')}}">Users</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route ('tags.index')}}">Tags</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route ('category.index')}}">Categories</a>
              </li>
              @endcan
              <!--    Create   -->
              @can('create-post')
              <li class="nav-item">
                <a class="nav-link" href="{{route ('post.create')}}">Create</a>
              </li>
              @endcan

              @if(Auth::user())
              <li class="nav-item">
                <a class="nav-link" href="{{route ('post.author',Auth::user()->id)}}">Profile</a>
              </li>
              @endif
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/about') }}">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/contact') }}">Contact</a>
              </li>
            </ul>


            <!-- search -->
            <div class="search">
              <button id="searchOpen" class="search-btn">
                <i class="ti-search"></i>
              </button>
              <div class="search-wrapper">

                <form action="{{ route('post.search') }}" method="GET">
                  @csrf
                  <input class="search-box pl-4" id="search-query" name="search" type="search" placeholder="Type & Hit Enter...">
                  <button id="searchClose" class="search-close">
                    <i class="ti-close text-dark"></i>
                  </button>
                </form>


              </div>
            </div>



          </div>

        </nav>
      </div>
    </header>
    <main>
      @yield('content')
    </main>
  </div>
  <footer class="section-sm pb-0 border-top border-default">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-md-3 mb-4">
          <a class="mb-4 d-block" href="index.html">
            <img class="img-fluid" width="150px" src="{{ asset('images/logo.png') }}" alt="LogBook">
          </a>
          <p>
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
          </p>
        </div>

        <div class="col-lg-2 col-md-3 col-6 mb-4">
          <h6 class="mb-4">Quick Links</h6>
          <ul class="list-unstyled footer-list">
            <li><a href="{{ url('/about') }}">About</a></li>
            <li><a href="{{ url('/contact') }}">Contact</a></li>
            <li><a href="privacy-policy.html">Privacy Policy</a></li>
            <li><a href="terms-conditions.html">Terms Conditions</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 col-6 mb-4">
          <h6 class="mb-4">Social Links</h6>
          <ul class="list-unstyled footer-list">
            <li><a href="https://www.facebook.com/profile.php?id=100055986965783">facebook</a></li>
            <li><a href="#">twitter</a></li>
            <li><a href="#">linkedin</a></li>
            <li><a href="#">github</a></li>
          </ul>
        </div>

        <div class="col-md-3 mb-4">
          <h6 class="mb-4">Subscribe Newsletter</h6>
          <form class="subscription" action="" method="post">
            @csrf
            <div class="position-relative">
              <i class="ti-email email-icon"></i>
              <input type="email" name="email" class="form-control" placeholder="Your Email Address" required>
            </div>
            <button class="btn btn-primary btn-block rounded" type="submit">Subscribe now</button>
          </form>
        </div>

      </div>
      <div class="scroll-top">
        <a href="javascript:void(0);" id="scrollTop"><i class="ti-angle-up"></i></a>
      </div>
    </div>
  </footer>

  <!-- JS Plugins -->
  <script src="{{ asset ('plugins/jQuery/jquery.min.js') }}"></script>
  <script src="{{ asset ('plugins/bootstrap/bootstrap.min.js') }}" async></script>
  <script src="{{ asset ('plugins/slick/slick.min.js') }}"></script>

  <!-- Main Script -->
  <script src="{{ asset ('js/script.js') }}"></script>

</body>
</html>