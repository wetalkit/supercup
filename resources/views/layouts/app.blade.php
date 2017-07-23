<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:url"           content="{{ url()->current() }}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Super Cup 2017 Accommodation" />
    <meta property="og:description"   content="This website is created to offer free tourist accommodation in Skopje for the upcoming UEFA Super Cup." />
    <meta property="og:image"         content="{{ url('/images/logo.png') }}" />

    <title>{{ config('app.name', 'Super Cup 2017 Accommodation') }}</title>
    
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-select.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-theme.min.css') }}" rel="stylesheet">    
    <link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    @yield('additionalCss')

</head>
<body>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=274999166309959";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <header>
        <nav class="nav-wrapper">
            <div class="logo">
                <a href="{{ url('/') }}">
                    <img src="/images/logo.png" class="logo">
                </a>
            </div>
            <ul class="menu js-main-nav">
                <li>
                    @if($user)
                        <a href="{{ route('listing.create') }}" class="become-a-host-btn">Become a Host</a>
                    @else
                        <a type="button" class="become-a-host-btn" data-toggle="modal"  data-target="#loginModal">Become a Host</a>
                    @endif
                </li>
                @if (!$user)
                    <li><a href="{{ route('login') }}">Login</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ $user->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                @foreach(Auth::user()->listings as $listing)
                                <a href="{{ route('listing.edit', $listing->id) }}">
                                    {{$listing->title}}
                                </a>
                                @endforeach
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif

            </ul>
        </nav>
        <div class="menu-trigger js-menu-trigger"></div>
    </header>
    <div class="main-overlay js-main-overlay"></div>   

    @yield('content')

    @include('layouts.footer')
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    @yield('additionalJs')

    @include('modals.signup')
</body>
</html>
