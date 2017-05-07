@extends('layouts.app')

@section('content')

    @component('layouts.components.center-card')

        @slot('header')
            Latest games
        @endslot

        @slot('content')
            <history></history>
        @endslot

    @endcomponent

@endsection
