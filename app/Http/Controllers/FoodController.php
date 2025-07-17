<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Http\Controllers\Controller;

class FoodController extends Controller
{
    public function userIndex()
    {
        $foods = Food::where('is_available', true)
            ->latest()
            ->paginate(12);
        return view('foods.index', compact('foods'));
    }

    public function show(Food $food)
    {
        if (!$food->is_available) {
            abort(404);
        }
        return view('foods.show', compact('food'));
    }
}