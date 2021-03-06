<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:url"           content="{{ url()->current() }}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Free Tourist Accommodation for Super Cup Skopje🇲🇰" />
    <meta property="og:description"   content="Super Cup Skopje is an open-source project created by the We Talk IT community, to offer FREE tourist accommodation in Skopje for the upcoming UEFA Super Cup 2017." />
    <meta property="og:image"         content="{{ url('/images/og-img.png') }}" />

    <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
    <link rel="manifest" href="/favicons/manifest.json">
    <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">

    <title>{{ config('app.name', 'Super Cup 2017 Accommodation') }}</title>
    
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-select.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-theme.min.css') }}" rel="stylesheet">    
    <link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}?q=1500913240" rel="stylesheet">

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    @yield('additionalCss')

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-103028181-1', 'auto');
      ga('send', 'pageview');

    </script>

</head>
<body>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId={{env('FB_CLIENT')}}";
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
                <li>
                    <a class="btn-orange-inverse spread-love" target="_blank" href="https://www.producthunt.com/posts/super-cup-2017-skopje">
                        <img src="/images/logo-ph.png" alt="" style="max-height:40px">
                        Give us a vote
                    </a>
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
                                <hr>
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
    <script>
        window.twttr = (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0],
            t = window.twttr || {};
          if (d.getElementById(id)) return t;
          js = d.createElement(s);
          js.id = id;
          js.src = "https://platform.twitter.com/widgets.js";
          fjs.parentNode.insertBefore(js, fjs);

          t._e = [];
          t.ready = function(f) {
            t._e.push(f);
          };

          return t;
        }(document, "script", "twitter-wjs"));
    </script>

    @yield('additionalJs')

    @include('modals.signup')
    @include('modals.share')
</body>
</html>
