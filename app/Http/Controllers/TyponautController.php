<?php

namespace App\Http\Controllers;

use App\Events\UserWasChallenged;
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

    public function challenge(User $user)
    {
        broadcast(new UserWasChallenged(auth()->user(), $user))->toOthers();

        return ['status' => 'OK'];
    }
}
