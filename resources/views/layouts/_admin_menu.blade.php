<nav class="navbar navbar-default navbar-static-top" role="navigation">

    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <img alt="Brand" src="/img/spectrum-logo-white.svg" style="width:200px" />
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
            @if(Sentinel::check())
            <ul class="nav navbar-nav">
                <li {{setActive('/admin')}}><a href="{{action('Admin\AdminController@index')}}">Home</a></li>
                <li {{setActive('admin/quotations')}}><a href="{{action('Admin\QuotationController@index')}}">Quotations</a></li>
                <li {{setActive('admin/orders')}}><a href="{{action('Admin\OrderController@index')}}">Orders</a></li>
                <li ><a href="javascript:alert('It\'s coming');">Invoices</a></li>
                <li {{setActive('admin/reports')}}><a href="{{action('Admin\ReportsController@index')}}">Reports</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ action("Admin\ProductsController@index") }}"><span class="fi-man-business-card fi-man"></span> Products</a></li>
                        <li><a href="{{ action("Admin\PaperController@index") }}"><span class="fi-misc-file fi-misc"></span> Papers</a></li>
                        <li><a href="{{ action("Admin\CategoryController@index") }}"><span class="fi-misc-inbox fi-misc"></span> Categories</a></li>
                        <li><a href="{{ action("Admin\SizesController@index")}}"><span class="fi-misc-layers fi-misc"></span> Sizes</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ action("Admin\CustomerController@index")}}"><span class="fi-misc-users fi-misc"></span> Customers</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{action('Admin\StaffController@index')}}"><span class="fi-misc-users fi-misc"></span> Staff</a></li>
                        <li><a href="{{ action("Admin\BranchController@index")}}"><span class="fi-shop-shop fi-shop"></span> Branches</a></li>
                    </ul>
                </li>
            </ul>
            @endif

            <ul class="nav navbar-nav navbar-right">

                @if(!Sentinel::check())
                    <li {{setActive('register')}}><a href="{{ action("RegistrationController@create")}}">Register</a></li>
                    <li {{setActive('login')}}><a href="{{ action("LoginController@loginForm")}}">Login</a></li>
                @else
                    {{--<li class="dropdown">--}}
                        {{--<a href="{{action('UserProfileController@view')}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profile <span class="caret"></span></a>--}}
                        {{--<ul class="dropdown-menu">--}}
                            {{--<li><a href="{{action('UserProfileController@viewAddresses')}}">Addresses</a></li>--}}
                            {{--<li><a href="{{action('UserProfileController@createAddress')}}">Create New Address</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li><a href="{{ action("UserProfileController@view")}}">Profile</a></li>--}}
                    <li><a href="{{ action("LoginController@logout")}}">Logout</a></li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>