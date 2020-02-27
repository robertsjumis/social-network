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
            <h3>Welcome to Pic-pies,</h3>
            <h3>the future of the social networks</h3>
            <br>
            <h5>This was created as a final test for <a href="https://www.codelex.io">Codelex</a> coding school</h5>
            <br>
            <h5>If you have come this far, you have probably glanced over the source code of all this.
                If not, you are welcome to visit <a href="https://www.github.com/robertsjumis/social-network">Github</a>
                where this project is published.</h5>

            <h5>Other than that, please use login/register to access the features of this social network!</h5>


        </div>
    </div>
@endsection
