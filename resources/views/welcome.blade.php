@extends('layouts.layout')

@section('content')
    <div id="page" class="container">
        <div id="header">
            <div id="menu">
                <ul>
                    <li class="current_page_item"><a href="{{ route('login') }}" accesskey="1" title="">Login</a></li>
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
            this is welcome page


            <div id="copyright">
                <span>&copy; Roberts Jumis. All rights reserved. </span>
                <span>Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>.</span>
            </div>
        </div>
    </div>
@endsection
