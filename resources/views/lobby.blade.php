@extends('layouts.app')

@section('content')

    @component('layouts.components.center-card')

        @slot('header')
            Lobby
        @endslot

        @slot('cardBlockClass')
            lobby-block
        @endslot

        @slot('content')
            <user-list :users_in_lobby="usersInLobby"></user-list>
        @endslot

    @endcomponent

@endsection
