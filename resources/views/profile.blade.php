@extends("layouts.app")

@section("content")
<h1>{{ $user->name }}</h1>
<h2>{{ $user->last_name }}</h2>
<h2>{{ $user->created_at }}</h2>
<h2>{{ $user->address}}</h2>
@endsection

{{ $user }}
