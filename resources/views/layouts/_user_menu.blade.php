<nav class="navbar navbar-default navbar-static-top" role="navigation">

    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li><a href="#">Home</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

                @if(!Sentinel::check())
                    <li><a href="{{ action("RegistrationController@create")}}">Register</a></li>
                    <li><a href="{{ action("LoginController@loginForm")}}">Login</a></li>
                @else
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="{{action('UserProfileController@')}}">Page 1
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{action('UserProfileController@view')}}">Addresses</a></li>
                            <li><a href="{{action('UserProfileController@createAddress')}}">Create New Address</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ action("UserProfileController@view")}}">Profile</a></li>
                    <li><a href="{{ action("LoginController@logout")}}">Logout</a></li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>