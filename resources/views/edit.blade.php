@extends('layouts.app')

@section("content")
    <body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Update profile') }}</div>
                    <div class="card-body">

                        <form action="{{ route('update.profile', $user) }}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="image"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
                                <div class="col-md-6">
                                    Select image to upload:
                                    <input type="file" name="image" id="fileToUpload">
                                    <input type="submit" value="Upload Image">
                                </div>
                            </div>
{{--                            <div class="form-group row">--}}
{{--                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="{{ $user->name }}" autofocus>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </body>
@endsection
