@extends("layouts.layout")

@section("content")
    <div id="page" class="container">
        <div id="header">
            <div id="logo">
                <img style="max-width:100px; max-height:100px" src="{{$user->image_location()}}" alt=""/>
                <h1><a href="/{{$user->id}}">{{ $user->name }} {{ $user->last_name }}</a></h1>
                @if($showEditProfileButton)
                    <form action="{{$user->id}}/edit" method="GET">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update profile') }}
                        </button>
                    </form>
                @endif
            </div>
            <div id="menu">
                <ul>
                    <li><a href="/" accesskey="1" title="">Main</a></li>
                    <li><a accesskey="2" title="">New Picsy</a>
                        <ul class="dropdown">
                            <li><a href="#">Gallery</a></li>
                            <li><a href="#">Post</a></li>
                        </ul>
                    </li>
                    <li><a href="#" accesskey="3" title="">Messages</a></li>
                    <li><a href="#" accesskey="4" title="">Friends</a></li>

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
            <img style="max-width:200px; max-height:200px" src="{{ $user->image_location() }}"
                 alt="User profile image">
            <div id="welcome">
                <div class="title">
                    <h2>{{ $user->name }} {{$user->last_name}}</h2>
                    <h5>{{ $user->bio()}}</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="name"
                           class="col-md-4 col-form-label text-md-right">Address</label>
                    <div class="col-md-6">
                        {{ $user->address()}}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name"
                           class="col-md-4 col-form-label text-md-right">Phone No.</label>
                    <div class="col-md-6">
                        {{ $user->phone()}}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name"
                           class="col-md-4 col-form-label text-md-right">Birthday</label>
                    <div class="col-md-6">
                        {{ $user->birthday()}}
                    </div>
                </div>
            </div>
            <div id="welcome">
                <div class="title">
                    <h4>Friends</h4>
                </div>
            </div>
            <div id="welcome">
                <div class="title">
                    <h4>Galleries</h4>
                </div>
            </div>
        </div>
    </div>
@endsection




