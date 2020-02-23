@extends('layouts.app')

@section("content")
    <body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Update profile') }}</div>
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
                                    <input type="file" name="image" id="fileToUpload">
                                    <input type="submit" value="Upload Image">
                                </div>
                            </div>
                        </form>
                        @foreach($user->getFillable() as $fillable)
                            @if($fillable == "password"|| $fillable == "image_location")
                                @continue
                            @endif
                            <form action="{{ route('update.profile', $user) }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @method("patch")
                                <div class="form-group row">
                                    <label for="name"
                                           class="col-md-4 col-form-label text-md-right">{{ __(str_replace("_", " ", ucfirst($fillable))) }}</label>
                                    <div class="col-md-6">
                                        <input id="name"
                                               @if ($fillable == "birthday")
                                               type="date"
                                               @elseif($fillable == "bio")
                                               type="textarea"
                                               @else
                                               type="text"
                                               @endif
                                               class="form-control @error($fillable) is-invalid @enderror"
                                               name="{{ $fillable }}"
                                               value="{{ $user->$fillable }}" required
                                               autocomplete="{{ $user->$fillable }}"
                                               autofocus>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </form>
                        @endforeach
                        <form action="{{ route('update.profile', $user) }}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @method("patch")
                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __(str_replace("_", " ", ucfirst($fillable))) }}</label>
                                <div class="col-md-6">
                                    <input id="name"
                                           @if ($fillable == "birthday")
                                           type="date"
                                           @elseif($fillable == "bio")
                                           type="textarea"
                                           @else
                                           type="text"
                                           @endif
                                           class="form-control @error($fillable) is-invalid @enderror"
                                           name="{{ $fillable }}"
                                           value="{{ $user->$fillable }}" required
                                           autocomplete="{{ $user->$fillable }}"
                                           autofocus>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">{{ __('Update password') }}</div>
                    <div class="card-body">
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
            </div>
        </div>
    </div>


    </body>
@endsection

