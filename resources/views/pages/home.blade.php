@extends('layouts.app')

@section('content')

    @component('layouts.components.center-card')

        @slot('header')
            Dashboard
        @endslot

        @slot('content')
            You are logged in!
        @endslot

    @endcomponent
    <countdown></countdown>

@endsection
