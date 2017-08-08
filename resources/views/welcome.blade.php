@extends('layouts.app')

@section('content')
    @include('layouts._partials.hero')

    <portfolio :sites="{{ $sites }}"></portfolio>


@endsection
