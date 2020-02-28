@extends("layouts.layout")
@section("content")
    <div id="page" class="container">
        <div id="header">
            <div id="logo">
                <img style="max-width:100px; max-height:100px" src="{{$user->image_location()}}" alt=""/>
                <h1><a href="/{{$user->slug}}">{{ $user->name }} {{ $user->last_name }}</a></h1>

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
                    <h2>Create a new post</h2>
                    <span
                        class="byline">He, who dont knows nothing, knows in fact everything</span>
                </div>

                <form action="/post/{{$post->id}}" method="POST">
                    @csrf
                    @method("put")
                    <input type="text" name="title" value="{{ $post->title }}" required/>
                    <textarea name="body" required>{{ $post->body }}</textarea>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>

            </div>

        </div>
    </div>
@endsection

