<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

    
    

    <title>@yield('title')</title>
</head>
<body>
<div class="container">


<div class="loginbox nav navbar-nav pull-right">

@if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
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

</div>


<div>
<h1>
<center>WELCOME TO BLOG</center>
</h1>
</div>
<br>
<br>


<nav class ="navbar navbar-default">
<div class="container-fluid">

<ul class="nav navbar-nav">
<li class="dropdown">
<a href="" class="dropdown-toggle" data-toggle="dropdown">sort posts by<span class="caret"></span></a>
<ul class="dropdown-menu">
<li><a href="{{route('getPublic',['type'=>'recentPosts'])}}">Top 10 Most Recent Posts</a></li>
<li><a href="{{route('getPublic',['type'=>'mostCommented'])}}">Top 10 Liked Posts</a></li>
<li><a href="{{route('getPublic',['type'=>'mostVisited'])}}">Top 10 Most Visited Posts</a></li>
</ul>
</li>

</ul>
@if(Auth::check())
<ul class="nav navbar-nav navbar-right">
    <li><a href="{{route('postrs.index')}}">manage blog post</a></li>
</ul>

@endif

</div>

</nav>


{{--container for containing top 10 posts in specified post categoreis--}}


<div>
<h
@yield('content')


<div class="footer text-center" style="margin:20px 0 60px 0;">
<p>&copy; Begin Programming</p>

</div>
    
</body>
</html>