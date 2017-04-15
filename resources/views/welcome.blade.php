<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

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
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap-select.min.js"></script>
        
        <!-- Styles -->
    </head>
    <body>
        <!-- Top Nav  -->
            @include("landing.topnav")
        <!-- Top Nav END -->
        
        <!-- Main Content -->
            @include("landing.content")
        <!-- Main Content END -->
        
        <!-- Modals -->
            @include("landing.modals")
        <!-- Modals END -->
        
        <!--footer-->
            @include("landing.footer")
        <!--footer END-->
    </body>
</html>
