@extends('layouts.app')

@section('content')

    @component('layouts.components.center-card')

        @slot('header')
            Game history
        @endslot

        @slot('content')
            <history></history>
        @endslot

    @endcomponent

@endsection
