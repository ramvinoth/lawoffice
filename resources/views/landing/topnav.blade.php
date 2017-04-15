<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="pull-left"><img src="{{ asset('images/meesai.png ') }}" width="100px" height="60px"></a>
            <a href="#">
                <div id="logotxt" class="logotxt">
                    <font face="myFbFont"> Tamizhan </font>
                </div>
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse mt10" id="bs-example-navbar-collapse-1">
             @if (Route::has('login'))
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#register-modal">Register</a></li>
                </ul>
            @endif    
           <!-- -->
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>