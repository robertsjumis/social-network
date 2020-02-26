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
                    <li><a accesskey="2" title="">New Picsy</a>
                        <ul class="dropdown">
                            <li><a href="{{route("gallery.create")}}">Gallery</a></li>
                            <li><a href="{{route("post.create")}}">Post</a></li>
                        </ul>
                    </li>
                    <li><a href="#" accesskey="3" title="">Messages</a></li>
                    <li class="current_page_item"><a href="/friends" accesskey="4" title="">Friends</a></li>
                    <li><a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <div id="main">

            <div id="welcome">
                <div class="title">
                    <h2>Friends</h2>
                    <span
                        class="byline">Long time no see</span>
                </div>
                @foreach($invitationSenders as $invitationSender)
                    <div>
                        <h5>{{$invitationSender->name}} {{$invitationSender->last_name}} sent you a friend request!</h5>
                        <form method="POST" action="friends/{{$invitationSender->id}}">
                            @csrf
                            @method("put")
                            <button type="submit" class="btn btn-primary">Accept</button>
                        </form>
                    </div>
                @endforeach

            </div>
            Friends
            @foreach($friends as $friend)
                <div>
                    <h5>{{$friend->name}} {{$friend->last_name}}</h5>
                </div>
            @endforeach
        </div>
    </div>
@endsection
