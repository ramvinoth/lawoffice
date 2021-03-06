<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Law Office Suite') }}</title>

     <!-- Fonts -->
     <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
           folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <!--link rel="stylesheet" href="../../plugins/datepicker/datepicker3.css"-->
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
        
        <!-- Scripts -->
        
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'auth_user' => Auth::user(),
        ]); ?>
    </script>
</head>
<body class="hold-transition fixed skin-blue sidebar-mini sidebar-collapse">
    <div id="opening_loader">
        <div class="loader">
            <h1>LOADING</h1>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div id="root" class="wrapper">
        <div id="wrapper">
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
        function notify(msg){
            noty({
                type: 'success',
                layout: 'bottomLeft',
                "timeout":3000,
                "closeButton":true,
                text: msg
            });
        }
    </script>
    
    
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    
    <script type="text/javascript" src="/js/custom.js"></script>
    
    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- datepicker -->
    <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
</body>
</html>
