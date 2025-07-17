<?php

namespace App\Http\Controllers\User;

use App\Models\Food;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function index()
    {
        $foods = Food::all();
        return view('user.menu', compact('foods'));
    }
}

