<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Log;

class FoodController extends Controller
{

    public function index()
    {
        $foods = Food::withTrashed()->latest()->paginate(10);
        return view('admin.foods.index', compact('foods'));
    }


    public function create()
    {
        return view('admin.foods.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_available' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $foodData = $request->except('image');
        $foodData['is_available'] = $request->has('is_available');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('foods', 'public');
            $foodData['image'] = $imagePath;
        }

        $food = Food::create($foodData);

        return redirect()->route('admin.foods.index')->with('success', 'Food item created successfully.');
    }

    /**
     * Display the specified food item.
     */
    public function show(Food $food)
    {

        Log::info($food);
        return view('admin.foods.show', compact('food'));
    }

    /**
     * Show the form for editing the specified food item.
     */
    public function edit(Food $food)
    {
        return view('admin.foods.edit', compact('food'));
    }

    /**
     * Update the specified food item in storage.
     */
    public function update(Request $request, Food $food)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_available' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $foodData = $request->except('image');
        $foodData['is_available'] = $request->has('is_available');

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($food->image && Storage::disk('public')->exists($food->image)) {
                Storage::disk('public')->delete($food->image);
            }
            $imagePath = $request->file('image')->store('foods', 'public');
            $foodData['image'] = $imagePath;
        }

        $food->update($foodData);

        return redirect()->route('admin.foods.index')->with('success', 'Food item updated successfully.');
    }

    /**
     * Remove the specified food item from storage (soft delete).
     */
    public function destroy(Food $food)
    {
        $food->delete();
        return redirect()->route('admin.foods.index')->with('success', 'Food item moved to trash.');
    }

    /**
     * Restore the specified food item from the trash.
     */
    public function restore($id)
    {
        $food = Food::withTrashed()->findOrFail($id);
        $food->restore();

        return redirect()->route('admin.foods.trash')
            ->with('success', 'Food item restored successfully.');
    }

    /**
     * Permanently delete the specified food item from storage.
     */
    public function forceDestroy($id)
    {
        $food = Food::withTrashed()->findOrFail($id);
        if ($food->image && Storage::disk('public')->exists($food->image)) {
            Storage::disk('public')->delete($food->image);
        }
        $food->forceDelete();
        return redirect()->route('admin.foods.index')->with('success', 'Food item permanently deleted.');
    }
    public function toggleDelete($id)
    {
        $food = Food::withTrashed()->findOrFail($id);
        if ($food->trashed()) {
            $food->restore();
        } else {
            $food->delete();
        }
        return redirect()->route('admin.foods.index')->with('status', 'Toggled food status');
    }
    public function trash()
    {
        $foods = Food::onlyTrashed()->latest()->paginate(10);
        return view('admin.foods.trash', compact('foods'));
    }

}
