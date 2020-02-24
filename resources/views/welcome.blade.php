@extends('layouts.layout')

@section('content')
    <div id="page" class="container">
        <div id="header">
            <div id="menu">
                <ul>
                    <li><a href="{{ route('login') }}" accesskey="1" title="">Login</a></li>
                    <li><a href="{{ route("register") }}" accesskey="2" title="">Register</a></li>
                </ul>
            </div>
        </div>
        <div id="main">
            <div id="welcome">
                <div class="title">
                    <h2>Welcome</h2>
                </div>
            </div>
            Welcome to my social network,

            You are welcome to use it, just login



        </div>
    </div>
@endsection
