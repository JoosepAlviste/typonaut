@extends('layouts.app')

@section('content')

    @component('layouts.components.center-card')

        @slot('header')
            History
        @endslot

        @slot('content')
            There will be some history here!
        @endslot

    @endcomponent

@endsection
