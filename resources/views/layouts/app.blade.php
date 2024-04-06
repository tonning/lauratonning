<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laura Tonning - Web Developer</title>

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    @include('layouts._partials.google-tag-manager', ['section' => 'head'])

</head>
<body>

    @include('layouts._partials.google-tag-manager', ['section' => 'body'])

    <div id="app">
        @yield('content')
    </div>

    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('/js/vendor.js') }}"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
