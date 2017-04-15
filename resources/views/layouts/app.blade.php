<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tamizhan') }}</title>

     <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="/css/fb_font/font.css" rel="stylesheet" type="text/css">
        <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="/css/styles.css" rel="stylesheet" type="text/css">
        <link href="/css/jquery-ui.min.css" rel="stylesheet">
        
        <!-- Scripts -->
        <script type="text/javascript" src="/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap-select.min.js"></script>
        <script type="text/javascript" src="/js/custom.js"></script>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <div id="wrapper">
        <init></init>
        @include("inner.topnav")
        @include("inner.leftnav")
            
        <div id="page-wrapper" class="gray-bg">
            @yield('content')
        </div>
        @if(Auth::check())
            <notification :id="{{ Auth::id() }}"></notification>
        @endif
        <audio id="noty_audio">
            <source src="{{ asset('audio/notify.mp3') }}">
            <source src="{{ asset('audio/notify.ogg') }}">
            <source src="{{ asset('audio/notify.wav') }}">
        </audio>
        </div>
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script>        
        @if(Session::has('success'))
            noty({
                type: 'success',
                layout: 'bottomLeft',
                text: '{{ Session::get('success') }}'
            });
        @endif
    </script>
</body>
</html>
