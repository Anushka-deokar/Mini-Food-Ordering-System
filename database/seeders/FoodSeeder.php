<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Food;
use Illuminate\Support\Facades\DB; // Import the DB facade

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('foods')->insert([
            [
                'name' => 'Pizza Margherita',
                'description' => 'Classic pizza with tomato sauce, mozzarella, and basil.',
                'price' => 12.50,
                'is_available' => true,
                'image' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hamburger',
                'description' => 'Juicy beef patty with lettuce, tomato, and cheese on a bun.',
                'price' => 8.99,
                'is_available' => true,
                'image' => 'https://images.unsplash.com/photo-1571091718767-190848894084?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Caesar Salad',
                'description' => 'Fresh romaine lettuce with croutons, parmesan, and Caesar dressing.',
                'price' => 7.50,
                'is_available' => true,
                'image' => 'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sushi Platter',
                'description' => 'Assorted sushi rolls and nigiri with soy sauce and wasabi.',
                'price' => 15.00,
                'is_available' => true,
                'image' => 'https://images.unsplash.com/photo-1579584425555-c3ce1784e1b1?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chocolate Cake',
                'description' => 'Rich chocolate cake with fudge frosting.',
                'price' => 6.00,
                'is_available' => true,
                'image' => 'https://plus.unsplash.com/premium_photo-1664647198302-c97255151817?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pasta Carbonara',
                'description' => 'Classic Italian pasta dish with eggs, cheese, pancetta, and black pepper.',
                'price' => 11.50,
                'is_available' => true,
                'image' => 'https://images.unsplash.com/photo-1600804340584-c7db2e501694?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chicken Curry',
                'description' => 'Delicious chicken curry with aromatic spices, served with rice.',
                'price' => 10.99,
                'is_available' => true,
                'image' => 'https://images.unsplash.com/photo-1614751013981-1b1b84888487?q=80&w=2073&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Grilled Salmon',
                'description' => 'Perfectly grilled salmon fillet with a side of roasted vegetables.',
                'price' => 16.75,
                'is_available' => true,
                'image' => 'https://images.unsplash.com/photo-1614788194335-e9a744828274?q=80&w=2024&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vegetable Stir-Fry',
                'description' => 'A colorful mix of stir-fried vegetables with tofu or tempeh.',
                'price' => 9.25,
                'is_available' => true,
                'image' => 'https://images.unsplash.com/photo-1592668289000-7551f5499e49?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tiramisu',
                'description' => 'Classic Italian dessert with coffee-soaked ladyfingers and mascarpone cream.',
                'price' => 7.00,
                'is_available' => true,
                'image' => 'https://images.unsplash.com/photo-1621996346565-e3dbc646d9a9?q=80&w=2073&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}