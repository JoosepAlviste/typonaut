<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function index()
    {
        $games = Game::with(['players', 'winner'])->latest()->get();

        return $games;
    }
}
