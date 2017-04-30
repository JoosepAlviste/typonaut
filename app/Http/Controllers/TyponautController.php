<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class TyponautController extends Controller
{
    public function challenge(User $user)
    {
        return ['status' => 'OK'];
    }
}
