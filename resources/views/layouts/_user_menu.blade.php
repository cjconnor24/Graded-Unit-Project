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
            <ul class="nav navbar-nav">
                <li><a href="{{action('PagesController@dashboard')}}">Home</a></li>
                <li {{setActive('quotations')}}><a href="{{action('UserQuotationController@index')}}">Quotations</a></li>
                <li {{setActive('orders')}}><a href="{{action('UserOrderController@index')}}">Orders</a></li>
                <li {{setActive('invoices')}}><a href="javascript:alert('I\'m getting there...');">Invoices</a></li>
                <li {{setActive('history')}}><a href="{{action('HistoryController@index')}}">Order History</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

                @if(!Sentinel::check())
                    <li><a href="{{ action("RegistrationController@create")}}">Register</a></li>
                    <li><a href="{{ action("LoginController@loginForm")}}">Login</a></li>
                @else
                    <li><a href="{{ action("UserProfileController@view")}}">Account</a></li>

                    {{--<li class="dropdown">--}}
                        {{--<a class="dropdown-toggle" data-toggle="dropdown" href="{{action('UserProfileController@view')}}">Manage Account--}}
                            {{--<span class="caret"></span></a>--}}
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