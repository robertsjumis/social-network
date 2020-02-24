@extends("layouts.app")

@section("content")
<h1>{{ $user->name }}</h1>
<h2>{{ $user->last_name }}</h2>
<h2>{{ $user->address()}}</h2>
<h2>{{ $user->phone()}}</h2>
<h2>{{ $user->birthday()}}</h2>
<h2>{{ $user->bio()}}</h2>
<img style="max-width:200px; max-height:200px" src="{{ $user->image_location() }}" alt="User profile image">

@endsection

{{ $user }}




