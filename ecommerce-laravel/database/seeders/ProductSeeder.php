<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed product_categories table
        $categories = ['Electronics', 'Fashion', 'Home Appliances', 'Books', 'Sports'];
        foreach ($categories as $category) {
            DB::table('product_categories')->updateOrInsert(
                ['name' => $category]
            );
        }

        // Get category IDs
        $electronicsId = DB::table('product_categories')->where('name', 'Electronics')->value('id');
        $fashionId = DB::table('product_categories')->where('name', 'Fashion')->value('id');
        $homeAppliancesId = DB::table('product_categories')->where('name', 'Home Appliances')->value('id');
        $booksId = DB::table('product_categories')->where('name', 'Books')->value('id');
        $sportsId = DB::table('product_categories')->where('name', 'Sports')->value('id');

        // Seed products table with 5 products for each category
        DB::table('products')->insert([
            // Electronics
            [
                'name' => 'Apple iPhone 14',
                'price' => 12000000,
                'description' => 'Latest Apple smartphone with advanced features.',
                'stock' => 50,
                'image' => 'iphone14.jpg',
                'product_category_id' => $electronicsId
            ],
            [
                'name' => 'Samsung Galaxy S23',
                'price' => 11000000,
                'description' => 'Flagship Samsung phone with powerful performance.',
                'stock' => 40,
                'image' => 'galaxy_s23.jpg',
                'product_category_id' => $electronicsId
            ],
            [
                'name' => 'Sony WH-1000XM4',
                'price' => 3500000,
                'description' => 'Noise cancelling wireless headphones.',
                'stock' => 30,
                'image' => 'sony_wh1000xm4.jpg',
                'product_category_id' => $electronicsId
            ],
            [
                'name' => 'Xiaomi Mi Band 7',
                'price' => 600000,
                'description' => 'Smart fitness tracker with heart rate monitor.',
                'stock' => 80,
                'image' => 'mi_band_7.jpg',
                'product_category_id' => $electronicsId
            ],
            [
                'name' => 'Logitech MX Master 3',
                'price' => 1200000,
                'description' => 'Advanced wireless mouse for productivity.',
                'stock' => 35,
                'image' => 'mx_master_3.jpg',
                'product_category_id' => $electronicsId
            ],

            // Fashion
            [
                'name' => 'Nike Air Max',
                'price' => 2000000,
                'description' => 'Comfortable and stylish running shoes.',
                'stock' => 100,
                'image' => 'nike_air_max.jpg',
                'product_category_id' => $fashionId
            ],
            [
                'name' => 'Levi\'s Jeans',
                'price' => 800000,
                'description' => 'Classic denim jeans for everyday wear.',
                'stock' => 75,
                'image' => 'levis_jeans.jpg',
                'product_category_id' => $fashionId
            ],
            [
                'name' => 'Adidas Hoodie',
                'price' => 650000,
                'description' => 'Warm and comfortable hoodie for casual wear.',
                'stock' => 60,
                'image' => 'adidas_hoodie.jpg',
                'product_category_id' => $fashionId
            ],
            [
                'name' => 'Gucci Sunglasses',
                'price' => 2500000,
                'description' => 'Stylish sunglasses for sunny days.',
                'stock' => 20,
                'image' => 'gucci_sunglasses.jpg',
                'product_category_id' => $fashionId
            ],
            [
                'name' => 'Casio G-Shock',
                'price' => 1500000,
                'description' => 'Durable and trendy wristwatch.',
                'stock' => 45,
                'image' => 'gshock.jpg',
                'product_category_id' => $fashionId
            ],

            // Home Appliances
            [
                'name' => 'Philips Blender',
                'price' => 650000,
                'description' => 'High quality blender for your kitchen.',
                'stock' => 25,
                'image' => 'philips_blender.jpg',
                'product_category_id' => $homeAppliancesId
            ],
            [
                'name' => 'Sharp Microwave',
                'price' => 1200000,
                'description' => 'Efficient microwave oven for fast cooking.',
                'stock' => 15,
                'image' => 'sharp_microwave.jpg',
                'product_category_id' => $homeAppliancesId
            ],
            [
                'name' => 'Panasonic Rice Cooker',
                'price' => 700000,
                'description' => 'Automatic rice cooker for perfect rice.',
                'stock' => 30,
                'image' => 'panasonic_rice_cooker.jpg',
                'product_category_id' => $homeAppliancesId
            ],
            [
                'name' => 'LG Refrigerator',
                'price' => 3500000,
                'description' => 'Spacious and energy efficient refrigerator.',
                'stock' => 10,
                'image' => 'lg_refrigerator.jpg',
                'product_category_id' => $homeAppliancesId
            ],
            [
                'name' => 'Miyako Electric Kettle',
                'price' => 250000,
                'description' => 'Fast boiling electric kettle.',
                'stock' => 40,
                'image' => 'miyako_kettle.jpg',
                'product_category_id' => $homeAppliancesId
            ],

            // Books
            [
                'name' => 'Atomic Habits',
                'price' => 150000,
                'description' => 'Best-selling self improvement book.',
                'stock' => 60,
                'image' => 'atomic_habits.jpg',
                'product_category_id' => $booksId
            ],
            [
                'name' => 'Rich Dad Poor Dad',
                'price' => 120000,
                'description' => 'Popular book about financial education.',
                'stock' => 50,
                'image' => 'rich_dad_poor_dad.jpg',
                'product_category_id' => $booksId
            ],
            [
                'name' => 'Harry Potter and the Sorcerer\'s Stone',
                'price' => 180000,
                'description' => 'Fantasy novel by J.K. Rowling.',
                'stock' => 40,
                'image' => 'harry_potter_1.jpg',
                'product_category_id' => $booksId
            ],
            [
                'name' => 'The Alchemist',
                'price' => 130000,
                'description' => 'Inspirational novel by Paulo Coelho.',
                'stock' => 35,
                'image' => 'the_alchemist.jpg',
                'product_category_id' => $booksId
            ],
            [
                'name' => 'Dilan 1990',
                'price' => 100000,
                'description' => 'Indonesian romance novel by Pidi Baiq.',
                'stock' => 70,
                'image' => 'dilan_1990.jpg',
                'product_category_id' => $booksId
            ],

            // Sports
            [
                'name' => 'Wilson Tennis Racket',
                'price' => 900000,
                'description' => 'Professional tennis racket for all levels.',
                'stock' => 20,
                'image' => 'wilson_racket.jpg',
                'product_category_id' => $sportsId
            ],
            [
                'name' => 'Adidas Soccer Ball',
                'price' => 350000,
                'description' => 'High quality soccer ball for matches.',
                'stock' => 50,
                'image' => 'adidas_soccer_ball.jpg',
                'product_category_id' => $sportsId
            ],
            [
                'name' => 'Yonex Badminton Racket',
                'price' => 400000,
                'description' => 'Lightweight racket for badminton players.',
                'stock' => 30,
                'image' => 'yonex_racket.jpg',
                'product_category_id' => $sportsId
            ],
            [
                'name' => 'Speedo Swimming Goggles',
                'price' => 150000,
                'description' => 'Comfortable goggles for swimming.',
                'stock' => 60,
                'image' => 'speedo_goggles.jpg',
                'product_category_id' => $sportsId
            ],
            [
                'name' => 'Nike Basketball Shoes',
                'price' => 1200000,
                'description' => 'High performance shoes for basketball.',
                'stock' => 25,
                'image' => 'nike_basketball_shoes.jpg',
                'product_category_id' => $sportsId
            ],
        ]);
    }
}
