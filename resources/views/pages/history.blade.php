@extends('layouts.app')

@section('content')

    @component('layouts.components.center-card')

        @slot('header')
            History
        @endslot

        @slot('content')
            <history :games="games"></history>
        @endslot

    @endcomponent

@endsection
