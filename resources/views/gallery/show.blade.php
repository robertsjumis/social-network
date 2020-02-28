@extends("layouts.layout")
@section("content")
    <div id="page" class="container">
        <div id="header">
            <div id="logo">
                <img style="max-width:100px; max-height:100px" src="{{$user->image_location()}}" alt=""/>
                <h1><a href="/{{$user->slug}}">{{ $user->name }} {{ $user->last_name }}</a></h1>
                <span><a href="/{{$user->slug}}#posts">Posts</a> | <a href="/{{$user->slug}}#galleries">Galleries</a></span>

            </div>
            <div id="menu">
                <ul>
                    <li><a href="/" accesskey="1" title="">Main</a></li>
                    <li class="current_page_item"><a accesskey="2" title="">New Pingy</a>
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
                    <h2>{{$gallery->title}}</h2>
                    <span
                        class="byline">Some other generic quote</span>
                </div>
                @foreach($images as $image)
                    <img style="max-width:100px; max-height:100px" src="{{asset($image)}}" alt=""/>
                @endforeach
            </div>
            Liked: {{$likeCount}}
            <form action="/gallery/{{$gallery->id}}/like" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Like</button>
            </form>
            <form action="/gallery/{{$gallery->id}}/like" method="POST">
                @csrf
                @method("delete")
                <button type="submit" class="btn btn-primary">Unlike</button>
            </form>
        </div>
    </div>
@endsection

