@extends("layouts.layout")

@section("content")
    <div id="page" class="container">
        <div id="header">
            <div id="logo">
                <img src="images/pic02.jpg" alt=""/>
                <h1><a href="/profile">Privy</a></h1>
                <span>Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a></span>
            </div>
            <div id="menu">
                <ul>
                    <li class="current_page_item"><a href="#" accesskey="1" title="">Main</a></li>
                    <li><a href="#" accesskey="2" title="">New Post</a></li>
                    <li><a href="#" accesskey="3" title="">Messages</a></li>
                    <li><a href="#" accesskey="4" title="">Galleries</a></li>
                    <li><a href="#" accesskey="5" title="">Friends</a></li>
                    <li><a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form></li>
                </ul>
            </div>
        </div>
        <div id="main">

            <div id="welcome">
                <div class="title">
                    <h2>Fusce ultrices fringilla metus</h2>
                    <span
                        class="byline">Donec leo, vivamus fermentum nibh in augue praesent a lacus at urna congue</span>
                </div>
                <p>This is <strong>Privy</strong>, a free, fully standards-compliant CSS template designed by <a
                        href="http://templated.co" rel="nofollow">TEMPLATED</a>. The photos in this template are from <a
                        href="http://fotogrph.com/"> Fotogrph</a>. This free template is released under the <a
                        href="http://templated.co/license">Creative Commons Attribution</a> license, so you're pretty
                    much free to do whatever you want with it (even use it commercially) provided you give us credit for
                    it. Have fun :) </p>
                <ul class="actions">
                    <li><a href="#" class="button">Etiam posuere</a></li>
                </ul>
            </div>
            <div id="featured">
                <div class="title">
                    <h2>Maecenas lectus sapien</h2>
                    <span class="byline">Integer sit amet aliquet pretium</span>
                </div>
                <ul class="style1">
                    <li class="first">
                        <p class="date"><a href="#">Jan<b>05</b></a></p>
                        <h3>Amet sed volutpat mauris</h3>
                        <p><a href="#">Consectetuer adipiscing elit. Nam pede erat, porta eu, lobortis eget, tempus et,
                                tellus. Etiam neque. Vivamus consequat lorem at nisl. Nullam non wisi a sem semper
                                eleifend. Etiam non felis. Donec ut ante.</a></p>
                    </li>
                    <li>
                        <p class="date"><a href="#">Jan<b>03</b></a></p>
                        <h3>Sagittis diam dolor amet</h3>
                        <p><a href="#">Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus
                                egestas at sem. Mauris quam enim, molestie. Donec leo, vivamus fermentum nibh in augue
                                praesent congue rutrum.</a></p>
                    </li>
                    <li>
                        <p class="date"><a href="#">Jan<b>01</b></a></p>
                        <h3>Amet sed volutpat mauris</h3>
                        <p><a href="#">Consectetuer adipiscing elit. Nam pede erat, porta eu, lobortis eget, tempus et,
                                tellus. Etiam neque. Vivamus consequat lorem at nisl. Nullam non wisi a sem semper
                                eleifend. Etiam non felis. Donec ut ante.</a></p>
                    </li>
                    <li>
                        <p class="date"><a href="#">Dec<b>31</b></a></p>
                        <h3>Sagittis diam dolor amet</h3>
                        <p><a href="#">Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus
                                egestas at sem. Mauris quam enim, molestie. Donec leo, vivamus fermentum nibh in augue
                                praesent congue rutrum.</a></p>
                    </li>
                </ul>
            </div>
            <div id="copyright">
                <span>&copy; Roberts Jumis. All rights reserved. </span>
                <span>Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>.</span>
            </div>
        </div>
    </div>
@endsection
