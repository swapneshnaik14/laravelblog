
@extends('layouts.template')

@section('title','blog admin panel')
@section('content')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<div class="loginbox nav navbar-nav pull-right">
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
                            </div>
                            <h1><center>Admin Panel</center></h1>
                           
<a href="{{route('postrs.create')}}" class="btn btn-primary pull-right">Add New Blog Post</a>
<a href="{{ url('/') }}" class="btn btn-primary pull-left">Go back</a>
<br>
<br>
<br>
<table class="table">
    <thead>
        <th>id</th>
        <th>title</th>
        <th>body</th>
        <th>edit</th>
        <th>delete</th>
    </thead>
   <tbody>
    @foreach($posts as $post)
    <tr>
        <th>{{$post->id}}</th>
        <td>{{$post->title}}</td>
        <td>{{$post->body}}</td>
        <td><a href="{{route('postrs.edit',['id'=>$post->id])}} " class="btn btn-info">Edit</a></td>
        <td>
        <form action="{{route('postrs.destroy',['id'=>$post->id])}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="DELETE">
        <input class="btn btn-danger" type="submit" value="Delete">
        </form>
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection