@extends ('layouts.app')

@section ('content')

    <game :game="{{ $game->toJson() }}"></game>

@endsection
