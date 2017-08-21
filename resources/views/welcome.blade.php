@extends('layouts.app')

@section('content')
    @include('layouts._partials.hero')

    @include('_partials.about')

    <div class="container is-hidden-mobile mt80">
        <hr>
    </div>

    <portfolio :sites="{{ $sites }}"></portfolio>
@endsection
