<!DOCTYPE html>
<html>
    <head>  
        @section('head')
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="/styles/style.css">        
        @show
    </head>
    <body>
        <header>                                  
            <nav>
                <ul>
                    <li>
                        {{ HTML::Link('/', 'Home Page') }}
                    </li>
                    @if(!Auth::check())
                    <li>
                        {{ HTML::Link('/account/create', 'Sign Up') }}
                    </li>
                    <li>
                        {{ HTML::Link('/account/login', 'Sign In') }}
                    </li> 
                    @else
                    <li>
                        {{ HTML::Link("/account/edit_password", 'Change Your Password') }}             
                    </li>
                    <li>
                        {{ HTML::Link('/account/logout', 'Logout') }}
                    </li>
                    @endif
                </ul>
            </nav>
        </header>
        <div class="message">
            @if(Session::has('message'))
                <h3> {{ Session::get('message') }} </h3>
            @endif
        </div>
        <div class="wrapper">
            @yield('content')
        </div>       
    </body>
</html>