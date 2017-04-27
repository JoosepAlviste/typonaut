@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">Lobby</div>

                    <div class="card-block lobby-block">
                        <user-list :users_in_lobby="usersInLobby"></user-list>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
