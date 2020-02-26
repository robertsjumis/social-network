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

        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div id="welcome">
                <div class="title">
                    <h2>Edit your profile</h2>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('updateImage.profile', $user) }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method("put")
                    <div class="form-group row">
                        <label for="image"
                               class="col-md-4 col-form-label text-md-right">{{ __('Profile picture') }}</label>
                        <div class="col-md-6">
                            <img style="max-width:100px; max-height:100px" src="{{ $user->image_location() }}"
                                 alt="User profile image">
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
                @foreach($user->getFillable() as $userProperty)
                    @if($userProperty == "password"|| $userProperty == "image_location")
                        @continue
                    @endif
                    <form action="{{ route('update.profile', $user) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method("patch")
                        <div class="form-group row">
                            <label for="name"
                                   class="col-md-4 col-form-label text-md-right">{{ __(str_replace("_", " ", ucfirst($userProperty))) }}</label>
                            <div class="col-md-6">
                                <input id="name"
                                       @if ($userProperty == "birthday")
                                       type="date"
                                       @elseif($userProperty == "bio")
                                       type="textarea"
                                       @else
                                       type="text"
                                       @endif
                                       class="form-control @error($userProperty) is-invalid @enderror"
                                       name="{{ $userProperty }}"
                                       value="{{ $user->$userProperty }}" required
                                       autocomplete="{{ $user->$userProperty }}"
                                       autofocus>
                            </div>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                @endforeach
            </div>
            <form>
                <div class="form-group row">
                    <label for="password"
                           class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                    <div class="col-md-6">
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password"
                               required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm"
                           class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control"
                               name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
