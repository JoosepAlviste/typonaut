@extends('layouts.app')

@section('content')

    @component('layouts.components.center-card')

        @slot('header')
            Game history
        @endslot

        @slot('content')
            There will be history here!
        @endslot

    @endcomponent

@endsection
