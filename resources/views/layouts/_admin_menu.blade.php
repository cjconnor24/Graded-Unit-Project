<nav class="navbar navbar-default navbar-static-top" role="navigation">

    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <img alt="Brand" src="/img/spectrum-logo.svg" style="width:200px" />
            </a>
        </div>
    </div>

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
                <li><a href="{{action('Admin\QuotationController@index')}}">Quotations</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ action("Admin\ProductsController@index") }}">Products</a></li>
                        <li><a href="{{ action("Admin\PaperController@index") }}">Papers</a></li>
                        <li><a href="{{ action("Admin\CategoryController@index") }}">Categories</a></li>
                        <li><a href="{{ action("Admin\SizesController@index")}}">Sizes</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ action("Admin\CustomerController@index")}}">Customers</a></li>
                        <li><a href="{{ action("Admin\BranchController@index")}}">Branches</a></li>
                    </ul>
                </li>


            </ul>

            <ul class="nav navbar-nav navbar-right">

                @if(!Sentinel::check())
                    <li><a href="{{ action("RegistrationController@create")}}">Register</a></li>
                    <li><a href="{{ action("LoginController@loginForm")}}">Login</a></li>
                @else
                    <li class="dropdown">
                        <a href="{{action('UserProfileController@view')}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profile <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{action('UserProfileController@viewAddresses')}}">Addresses</a></li>
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