<?php

namespace App\Services;

use App\Models\Food;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FoodService
{
    public function getPaginatedFoods()
    {
        return Food::withTrashed()->latest()->paginate(10);
    }

    public function createFood(array $foodData): Food
    {

        if (isset($foodData['image']) && $foodData['image']->isValid()) {
            $imagePath = $foodData['image']->store('foods', 'public');
            $foodData['image'] = $imagePath;
        }
        $foodData['is_available'] = isset($foodData['is_available']) ? $foodData['is_available'] : false;
        return Food::create($foodData);
    }



    public function updateFood(Food $food, array $foodData): void
    {
        // Handle image upload if a new image is provided
        if (isset($foodData['image']) && $foodData['image']->isValid()) {
            // Delete the old image if it exists
            if ($food->image && Storage::disk('public')->exists($food->image)) {
                Storage::disk('public')->delete($food->image);
            }
            $imagePath = $foodData['image']->store('foods', 'public');
            $foodData['image'] = $imagePath;
        }
        $foodData['is_available'] = isset($foodData['is_available']) ? $foodData['is_available'] : false;
        $food->update($foodData);
    }

    public function deleteFood(Food $food): void
    {
        $food->delete();
    }

    public function restoreFood(int $id): void
    {
        Food::withTrashed()->findOrFail($id)->restore();
    }

    public function forceDeleteFood(int $id): void
    {
        $food = Food::withTrashed()->findOrFail($id);
        if ($food->image && Storage::disk('public')->exists($food->image)) {
            Storage::disk('public')->delete($food->image);
        }
        $food->forceDelete();
    }

    public function toggleAvailability(Food $food): void
    {
        $food->is_available = !$food->is_available;
        $food->save();
    }
}