<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function lobby()
    {
        return view('lobby');
    }

    public function history()
    {
        return view('game-history');
    }
}
