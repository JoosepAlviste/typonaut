<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class TyponautController extends Controller
{
    /**
     * TyponautController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
