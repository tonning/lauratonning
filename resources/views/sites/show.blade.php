@extends('layouts.app')

@section('content')
    @include('layouts._partials.site-hero', ['screenshotsCount' => $site->getMedia('default')->count(), 'codeSamplesCount' => $site->codeSamples()->count()])

    <section class="section">
        <div class="container content" id="overview">

            <div class="box mb60" id="overview">
                <h1 class="title">{{ $site->name }}</h1>
                <h6 class="subtitle">
                    <a href="{{ $site->url }}">{{ $site->url }}</a>
                </h6>
                <div class="tags">
                    @foreach($site->tags as $tag)
                        <div class="tag">{{ $tag->name }}</div>
                    @endforeach
                </div>
                @if($site->description)
                    <p>{{ $site->description }}</p>
                @endif
            </div>

            @unless($site->getMedia('default')->isEmpty())
                <h2 class="title is-4" id="screenshots">Screenshots</h2>
                <div class="masonry">
                    @foreach($site->getMedia('default') as $key => $media)
                        <div class="item">
                            <div class="box">
                                <figure class="m0">
                                    <a href="{{ $media->getUrl() }}">
                                        <img src="{{ $media->getUrl() }}" alt="">
                                    </a>
                                    @if ($media->hasCustomProperty('caption'))
                                        <figcaption>
                                            Figure {{ $key + 1 }}: {{ $media->getCustomProperty('caption') }}
                                        </figcaption>
                                    @endif
                                </figure>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endunless

            @unless($site->codeSamples->isEmpty())
                <h2 class="title is-4" id="code-samples">Code Samples</h2>
                @foreach($site->codeSamples as $key => $sample)
                    <figure class="m0 mb50" v-pre>
                        <highlight-code lang="{{ $sample->language }}">
                            {{ $sample->snippet }}
                        </highlight-code>
                        <figcaption>
                            Code sample {{ $key + 1 }}: {{ $sample->caption }}
                        </figcaption>
                        <div class="tag">{{ $sample->language }}</div>
                    </figure>
                @endforeach
            @endunless

        </div>
    </section>
@endsection
