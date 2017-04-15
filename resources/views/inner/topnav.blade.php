<nav id="topheader" class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{ url('/') }}" class="pull-left"><img src="{{ asset('images/meesai.png ') }}" width="50px" height="30px"></a>
            <a href="{{ url('/') }}">
                <div id="logotxt" class="logotxt fs20px">
                    <font face="myFbFont"> Tamizhan </font>
                </div>
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
             @if (Route::has('login'))
                <ul class="nav navbar-nav navbar-right topbar-rightnav">
                    <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            @if(Auth::check())
                                <search></search>
                            @endif
                            @if(Auth::check())
                                <unread></unread>
                            @endif
                            <li class="dropdown top-profile">
                                <a href="#" class="dropdown-toggle topbarImage" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <img src="{{Auth::user()->avatar}}" alt="" width="32px" height="32px" class="avatar-feed">
                                    <!--span class="caret"></span-->
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ route('profile', ['slug' => Auth::user()->slug ]) }}">My profile</a></li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                </ul>
            @endif    
           <!-- -->
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
