@extends('layouts.app')

@section('content')
    <section class="hero is-primary is-medium">
        <!-- Hero header: will stick at the top -->
        <div class="hero-head">
            <header class="nav">
                <div class="container">
                    <div class="nav-left">
                        <a class="nav-item">
                            <img src="images/logo.png" alt="Logo">
                        </a>
                    </div>
                    <span class="nav-toggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    <div class="nav-right nav-menu">
                        <a class="nav-item is-active">
                            About
                        </a>
                        <a class="nav-item">
                            Sites Portfolio
                        </a>
                        <a href="https://github.com/tonning/" class="nav-item">
                            <svgicon icon="brands/github" height="24" width="24" class=""></svgicon> GitHub
                        </a>
                        <a href="https://twitter.com/tonning" class="nav-item">
                            <svgicon icon="brands/twitter" height="24" width="24" class=""></svgicon> Twitter
                        </a>
                    </div>
                </div>
            </header>
        </div>

        <!-- Hero content: will be in the middle -->
        <div class="hero-body">
            <div class="container has-text-centered">
                <h1 class="title">
                    Kristoffer Tonning
                </h1>
                <div class="subtitle">
                    <h3 class="is-size-5"><strong>Laravel</strong> geek | <strong>Vue.js</strong> enthusiast | Lover of <strong>Design</strong> | Husband of <strong>Wife</strong></h3>
                    <h2 class="is-size-6">Full-stack Web Developer</h2>
                </div>
            </div>
        </div>

        <!-- Hero footer: will stick at the bottom -->
        {{--<div class="hero-foot">--}}
            {{--<nav class="tabs">--}}
                {{--<div class="container">--}}
                    {{--<ul>--}}
                        {{--<li class="is-active"><a>Overview</a></li>--}}
                        {{--<li><a>Modifiers</a></li>--}}
                        {{--<li><a>Grid</a></li>--}}
                        {{--<li><a>Elements</a></li>--}}
                        {{--<li><a>Components</a></li>--}}
                        {{--<li><a>Layout</a></li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</nav>--}}
        {{--</div>--}}
    </section>

    <portfolio :sites="{{ $sites }}"></portfolio>


@endsection
