<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameHistoryController extends Controller
{
    public function index()
    {
        return view('game-history');
    }
}
