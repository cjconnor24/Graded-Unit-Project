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
                <li class="active"><a href="/">Home</a></li>
                <li><a href="{{ action("ProductsController@index") }}">Products</a></li>
                <li><a href="{{ action("PaperController@index") }}">Papers</a></li>
                <li><a href="{{ action("CategoryController@index") }}">Categories</a></li>
                <li><a href="{{ action("SizesController@index")}}">Sizes</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

                @if(!Sentinel::check())
                    <li><a href="{{ action("RegistrationController@create")}}">Register</a></li>
                    <li><a href="{{ action("LoginController@loginForm")}}">Login</a></li>
                @else
                    <li><a href="{{ action("LoginController@logout")}}">Logout, {{Sentinel::getUser()->first_name}}</a></li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>