@extends("layouts.layout")
@section("content")
    <div id="page" class="container">
        <div id="header">
            <div id="logo">
                <img style="max-width:100px; max-height:100px" src="{{$user->image_location()}}" alt=""/>
                <h1><a href="/{{$user->id}}">{{ $user->name }} {{ $user->last_name }}</a></h1>
            </div>
            <div id="menu">
                <ul>
                    <li><a href="/" accesskey="1" title="">Main</a></li>
                    <li><a href="#" accesskey="2" title="">New Post</a></li>
                    <li><a href="#" accesskey="3" title="">Messages</a></li>
                    <li><a href="#" accesskey="4" title="">Friends</a></li>
                    <li><a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form></li>
                </ul>
            </div>
        </div>
        <div id="main">
            <h1>{{ $user->name }} {{ $user->last_name }}</h1>

            <h2>Address: {{ $user->address()}}</h2>
            <h2>Phone: {{ $user->phone()}}</h2>
            <h2>Birthday: {{ $user->birthday()}}</h2>
            <h2>Bio: {{ $user->bio()}}</h2>
            <img style="max-width:200px; max-height:200px" src="{{ $user->image_location() }}" alt="User profile image">

        </div>
    </div>
@endsection




