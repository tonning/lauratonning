<section class="hero is-primary is-medium">
    <!-- Hero header: will stick at the top -->
    <div class="hero-head">
        <header class="nav">
            <div class="container">
                <div class="nav-left">
                    <a class="nav-item" href="/">
                        <img src="/images/logo.png" alt="Logo">
                    </a>
                </div>
                <span class="nav-toggle" @click="showNavbar = ! showNavbar">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
                <div class="nav-right nav-menu" :class="{'is-active': showNavbar}">
                    <a v-scroll-to="{el: '#about', offset: -40}" class="nav-item is-active">
                        About
                    </a>
                    <a v-scroll-to="'#portfolio'" class="nav-item">
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
            <h1 class="title is-2">
                Kristoffer Tonning
            </h1>
            <div class="subtitle">
                <h3 class="is-size-4">
                    <strong><a href="https://laravel.com" target="_blank">Laravel</a></strong> geek |
                    <strong><a href="https://vuejs.org/" target="_blank">Vue.js</a></strong> enthusiast |
                    Lover of <strong><a href="https://dribbble.com" target="_blank">Design</a></strong> |
                    Husband of <strong><a href="{{ asset('images/m.jpg') }}" target="_blank">Wife</a></strong></h3>
                <h2 class="is-size-5">Full-stack Web Developer</h2>
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
