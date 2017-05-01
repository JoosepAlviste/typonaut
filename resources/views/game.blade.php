@extends('layouts.app')

@section('content')

    @component('layouts.components.center-card')

        @slot('header')
            Game vs. {{ $opponent->name }}
        @endslot

        @slot('content')
            <game game_id="{{ $game->id }}"></game>
        @endslot

    @endcomponent

@endsection
