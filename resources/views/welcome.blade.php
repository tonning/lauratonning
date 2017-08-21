@extends('layouts.app')

@section('content')
    @include('layouts._partials.hero')

    @include('_partials.about')

    <div class="container is-hidden-mobile mt80">
        <hr>
    </div>

    <portfolio :sites="{{ $sites }}"></portfolio>

    <footer class="footer">
        <div class="container">
            <div class="content has-text-centered">
                <p>
                    Personal website for <a href="mailto:hello@kristoffertonning.com"><strong>Kristoffer Tonning</strong></a>. The source code is available at <a
                            href="https://github.com/tonning/kristoffertonning">Github</a>
                    (<a href="http://opensource.org/licenses/mit-license.php">MIT</a>).
                </p>
                {{--<p>Contact me at <a href="mailto:hello@kristoffertonning.com">hello@kristoffertonning.com</a></p>--}}
                <p>
                    <a href="https://github.com/tonning/" class="icon" target="_blank">
                        <svgicon icon="brands/github" height="24" width="24" class=""></svgicon>
                    </a>
                    <a href="https://twitter.com/tonning" class="icon" target="_blank">
                        <svgicon icon="brands/twitter" height="24" width="24" class=""></svgicon>
                    </a>
                    <a href="https://linkedin.com/in/tonning" class="icon" target="_blank">
                        <svgicon icon="brands/linkedin" height="24" width="24" class=""></svgicon>
                    </a>
                    <a href="mailto:hello@kristoffertonning.com" class="icon" target="_blank">
                        <svgicon icon="brands/mail" height="24" width="24" class=""></svgicon>
                    </a>
                </p>
            </div>
        </div>
    </footer>
@endsection
