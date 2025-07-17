<?php

namespace App\Observers;

use App\Models\Food;
use Illuminate\Support\Facades\Log;

class FoodObserver
{
    /**
     * Handle the Food "created" event.
     */
    public function created(Food $food): void
    {
        Log::info("Food item created: {$food->name} (ID: {$food->id})");
    }

    /**
     * Handle the Food "updated" event.
     */
    public function updated(Food $food): void
    {
        Log::info("Food item updated: {$food->name} (ID: {$food->id})");

        // Example: If a price is updated, we log the old and new prices
        if ($food->isDirty('price')) {
            $oldPrice = $food->getOriginal('price');
            Log::info("Price updated for {$food->name}: Old Price: {$oldPrice}, New Price: {$food->price}");
        }
    }

    /**
     * Handle the Food "deleted" event.
     */
    public function deleted(Food $food): void
    {
        Log::warning("Food item deleted: {$food->name} (ID: {$food->id})");

        // Example: If a food item is deleted, we might want to notify the admin
        // You could trigger an email notification or other action here.
    }

    /**
     * Handle the Food "restored" event.
     */
    public function restored(Food $food): void
    {
        Log::info("Food item restored: {$food->name} (ID: {$food->id})");

        // Example: Handle specific actions after a food item is restored, like updating the stock or notifying users
    }

    /**
     * Handle the Food "force deleted" event.
     */
    public function forceDeleted(Food $food): void
    {
        Log::critical("Food item force deleted: {$food->name} (ID: {$food->id})");

        // Example: Take additional steps when the food is permanently deleted, such as triggering alerts or clearing related data
    }
}
