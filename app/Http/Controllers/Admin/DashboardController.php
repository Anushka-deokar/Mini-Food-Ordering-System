<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\View\View;


class DashboardController extends Controller
{
    public function index(): View
    {
        $foods = Food::withTrashed()->latest()->paginate(5);
        return view('admin.dashboard', compact('foods'));
    }
}