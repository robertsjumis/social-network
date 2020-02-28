@extends("layouts.layout")

@section("content")
    <div id="page" class="container">
        <div id="header">
            <div id="logo">
                <img style="max-width:100px; max-height:100px" src="{{$user->image_location()}}" alt=""/>
                <h1><a href="/{{$user->slug}}">{{ $user->name }} {{ $user->last_name }}</a></h1>
                <span><a href="/{{$user->slug}}#posts">Posts</a> | <a href="/{{$user->slug}}#galleries">Galleries</a></span>

                {{--                zemāko ifu jāaizvieto ar policy--}}
                @if($showEditProfileButton)
                    <form action="{{$user->slug}}/edit" method="GET">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update profile') }}
                        </button>
                    </form>
                @endif
            </div>
            <div id="menu">
                <ul>
                    <li><a href="/" accesskey="1" title="">Main</a></li>
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
            <img style="max-width:200px; max-height:200px" src="{{ $viewedUser->image_location() }}"
                 alt="User profile image">
            <div id="welcome">
                <div class="title">
                    <h2>{{ $viewedUser->name }} {{$viewedUser->last_name}}</h2>
                    <h5>{{ $viewedUser->bio()}}</h5>
                    <form action="/friends/{{$viewedUser->slug}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-light">Invite friend</button>
                    </form>
                    <form action="/friends/{{$viewedUser->slug}}" method="POST">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-light">Unfriend</button>
                    </form>
                    <form action="/followers/{{$viewedUser->slug}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-dark">Follow</button>
                    </form>
                    <form action="/followers/{{$viewedUser->slug}}" method="POST">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-dark">Unfollow</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="name"
                           class="col-md-4 col-form-label text-md-right">Address</label>
                    <div class="col-md-6">
                        {{ $viewedUser->address()}}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name"
                           class="col-md-4 col-form-label text-md-right">Phone No.</label>
                    <div class="col-md-6">
                        {{ $viewedUser->phone()}}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name"
                           class="col-md-4 col-form-label text-md-right">Birthday</label>
                    <div class="col-md-6">
                        {{ $viewedUser->birthday()}}
                    </div>
                </div>
            </div>
            <div id="welcome">
                <div class="title">
                    <h4>Friends</h4>
                    @foreach($friends as $friend)
                        <div>
                            <h5><a href="{{$friend->slug}}">{{$friend->name}} {{$friend->last_name}}</a></h5>
                        </div>
                    @endforeach
                </div>
            </div>
            <div id="welcome">
                <div class="title">
                    <h4 id="galleries">Galleries</h4>
                    @foreach($galleries as $gallery)
                        <div>
                            <h5><a href="/gallery/{{$gallery->id}}">{{$gallery->title}}</a> @ {{$gallery->created_at}}</h5>
                        </div>
                    @endforeach
                </div>
            </div>
            <div id="welcome">
                <div class="title">
                    <h4 id="posts">Posts</h4>
                    @foreach($posts as $post)
                        <div>
                            <h5><a href="/post/{{$post->id}}">{{$post->title}}</a> @ {{$post->created_at}}</h5>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection




