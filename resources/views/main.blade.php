@extends("layouts.layout")
@section("content")
    <div id="page" class="container">
        <div id="header">
            <div id="logo">
                <img style="max-width:100px; max-height:100px" src="{{$user->image_location()}}" alt=""/>
                <h1><a href="/{{$user->slug}}">{{ $user->name }} {{ $user->last_name }}</a></h1>
                <span><a href="/{{$user->slug}}#galleries">Posts</a> | <a href="/{{$user->slug}}">Galleries</a></span>
            </div>
            <div id="menu">
                <ul>
                    <li class="current_page_item"><a href="/" accesskey="1" title="">Main</a></li>
                    <li><a accesskey="2" title="">New Pingy</a>
                        <ul class="dropdown">
                            <li><a href="{{route("gallery.create")}}">Gallery</a></li>
                            <li><a href="{{route("post.create")}}">Post</a></li>
                        </ul>
                    </li>
                    <li><a href="/messages" accesskey="3" title="">Messages</a></li>
                    <li><a href="/friends" accesskey="4" title="">Friends</a></li>
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
                    <h2>New posts n stuff</h2>
                    <span
                        class="byline">Cool stuff, huh?</span>
                </div>

            </div>
            @if(count($posts) == 0)
                <h4>Nothing here right now</h4>
            @endif
            @foreach($posts as $post)
                <div id="featured">
                    <div class="title">
                        <h3><a href="/post/{{$post->id}}">{{$post->title}}</a></h3>
                        <span class="byline">By
                        @foreach($users as $user)
                                @if($user->id == $post->created_by)
                                    <a href="/{{$user->slug}}">{{$user->name}} {{$user->last_name}}</a>
                                @endif
                            @endforeach
                        @ {{$post->created_at}}</span>
                        <h5>{{$post->body}}</h5>

                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection
