@extends("layouts.layout")
@section("content")
    <div id="page" class="container">
        <div id="header">
            <div id="logo">
                <img style="max-width:100px; max-height:100px" src="{{$user->image_location()}}" alt=""/>
                <h1><a href="/{{$user->slug}}">{{ $user->name }} {{ $user->last_name }}</a></h1>
                <span><a href="/{{$user->slug}}#posts">Posts</a> | <a
                        href="/{{$user->slug}}#galleries">Galleries</a></span>
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
                    <h2>Modify your gallery</h2>
                    <form method="POST" action="/gallery/{{$gallery->id}}">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-danger">
                            Delete gallery
                        </button>
                    </form>
                </div>

                <form action="/gallery" method="POST">
                    @csrf
                    @method("put")
                    Gallery name:
                    <input type="text" name="title" value="{{$gallery->title}}" required/>

                    <button type="submit" class="btn btn-primary">Next</button>
                </form>
                @foreach($images as $image)
                    <br>
                    <img style="max-width:200px; max-height:200px" src="{{asset($image)}}" alt=""/>
                    <form method="POST" action="/">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-danger">
                            Delete image
                        </button>
                    </form>
                @endforeach
                <form action="/gallery/{{$gallery->id}}/image" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="image"
                               class="col-md-4 col-form-label text-md-right">{{ __('Add image') }}</label>
                        <div class="col-md-6">

                            Select image to upload:
                            <input type="file" name="image" id="fileToUpload"
                                   class="@error('image') is-invalid @enderror">
                            <input type="submit" name="uploadImage" value="Upload Image">
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </form>
                <form action="/gallery/{{$gallery->id}}" method="GET">
                    <button type="submit" class="btn btn-light">
                        Done
                    </button>
                </form>
            </div>

        </div>
    </div>
@endsection

