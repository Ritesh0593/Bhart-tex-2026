<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Categories
        $categoriesData = [
            [
                'id' => 1,
                'name' => "Men's Wear",
                'slug' => 'mens-wear',
                'image_path' => 'images/hoodie_red.png'
            ],
            [
                'id' => 2,
                'name' => 'Knitwear',
                'slug' => 'knitwear',
                'image_path' => 'images/shirt_black.webp'
            ],
            [
                'id' => 3,
                'name' => "Women's Wear",
                'slug' => 'womens-wear',
                'image_path' => 'images/dress_yellow.webp'
            ],
            [
                'id' => 4,
                'name' => 'Sportswear',
                'slug' => 'sportswear',
                'image_path' => 'images/shirt_blue_hanger.webp'
            ],
            [
                'id' => 5,
                'name' => 'Ethnic Wear',
                'slug' => 'ethnic-wear',
                'image_path' => 'images/hoodie_red.png'
            ],
            [
                'id' => 6,
                'name' => 'Winter Wear',
                'slug' => 'winter-wear',
                'image_path' => 'images/shirt_black.webp'
            ]
        ];

        foreach ($categoriesData as $c) {
            Category::updateOrCreate(['id' => $c['id']], [
                'name' => $c['name'],
                'slug' => $c['slug'],
                'image_path' => $c['image_path']
            ]);
        }

        // 2. Create Products
        $productsData = [
            // Winter Wear
            [
                'category_id' => 6,
                'name' => 'Premium Cotton Hoodie',
                'slug' => 'premium-cotton-hoodie',
                'price' => 1499,
                'product_type' => 'Hooded Sweatshirt',
                'material' => '100% Premium Cotton Fleece',
                'gsm' => 320,
                'color' => 'Maroon',
                'sizes' => 'S, M, L, XL, XXL',
                'brand_name' => 'Bharat Tex Collection',
                'manufacturer' => 'XYZ Textiles Pvt. Ltd.',
                'state' => 'Delhi',
                'district' => 'New Delhi',
                'address' => 'Bharat Mandapam Exhibition Hall, Pragati Maidan, New Delhi – 110001',
                'mobile' => '+91 98765 43210',
                'description' => 'Premium-quality cotton hoodie crafted for comfort and durability.',
                'images' => [
                    ['path' => 'images/hoodie_red.png', 'primary' => true],
                    ['path' => 'images/hoodie_red.png', 'primary' => false],
                ]
            ],
            [
                'category_id' => 6,
                'name' => 'Classic White Hoodie',
                'slug' => 'classic-white-hoodie',
                'price' => 1299,
                'product_type' => 'Hooded Sweatshirt',
                'material' => '80% Cotton, 20% Polyester',
                'gsm' => 300,
                'color' => 'White',
                'sizes' => 'M, L, XL',
                'brand_name' => 'Bharat Tex Collection',
                'manufacturer' => 'ABC Knitwear',
                'state' => 'Punjab',
                'district' => 'Ludhiana',
                'address' => 'Stall 4, Hall 2, Bharat Mandapam, Pragati Maidan, New Delhi',
                'mobile' => '+91 98765 43211',
                'description' => 'A clean, timeless aesthetic white hoodie designed for everyday lifestyle.',
                'images' => [
                    ['path' => 'images/hoodie_white.webp', 'primary' => true]
                ]
            ],
            [
                'category_id' => 6,
                'name' => 'Fleece Winter Hoodie',
                'slug' => 'fleece-winter-hoodie',
                'price' => 1699,
                'product_type' => 'Hooded Sweatshirt',
                'material' => '100% Polyester Fleece',
                'gsm' => 340,
                'color' => 'Navy Blue',
                'sizes' => 'S, M, L, XL',
                'brand_name' => 'WarmTex',
                'manufacturer' => 'Ludhiana Woolens',
                'state' => 'Punjab',
                'district' => 'Ludhiana',
                'address' => 'Stall 18, Hall 3, Bharat Mandapam, Pragati Maidan, New Delhi',
                'mobile' => '+91 98765 43212',
                'description' => 'Engineered for extreme winters with brush-back soft fleece.',
                'images' => [
                    ['path' => 'images/hoodie_red.png', 'primary' => true]
                ]
            ],
            [
                'category_id' => 6,
                'name' => 'Casual Everyday Hoodie',
                'slug' => 'casual-everyday-hoodie',
                'price' => 999,
                'product_type' => 'Hooded Sweatshirt',
                'material' => '60% Cotton, 40% Polyester',
                'gsm' => 280,
                'color' => 'Black',
                'sizes' => 'M, L, XL, XXL',
                'brand_name' => 'DailyWear',
                'manufacturer' => 'Surat Fabrics',
                'state' => 'Gujarat',
                'district' => 'Surat',
                'address' => 'Stall 9, Hall 4, Bharat Mandapam, Pragati Maidan, New Delhi',
                'mobile' => '+91 98765 43213',
                'description' => 'Lightweight black hoodie perfect for mild winter days or layering.',
                'images' => [
                    ['path' => 'images/hoodie_brown.webp', 'primary' => true]
                ]
            ],

            // Men's Wear
            [
                'category_id' => 1,
                'name' => 'Premium Casual Hoodie',
                'slug' => 'premium-casual-hoodie',
                'price' => 1499,
                'product_type' => 'Hooded Sweatshirt',
                'material' => '100% Cotton',
                'gsm' => 320,
                'color' => 'Red',
                'sizes' => 'S, M, L, XL',
                'brand_name' => 'Bharat Tex Collection',
                'manufacturer' => 'XYZ Textiles Pvt. Ltd.',
                'state' => 'Delhi',
                'district' => 'New Delhi',
                'address' => 'Bharat Mandapam, Pragati Maidan, New Delhi',
                'mobile' => '+91 98765 43210',
                'description' => 'Premium casual wear red hoodie.',
                'images' => [
                    ['path' => 'images/hoodie_red.png', 'primary' => true]
                ]
            ]
        ];

        foreach ($productsData as $p) {
            $product = Product::updateOrCreate(['slug' => $p['slug']], [
                'category_id' => $p['category_id'],
                'name' => $p['name'],
                'price' => $p['price'],
                'product_type' => $p['product_type'],
                'material' => $p['material'],
                'gsm' => $p['gsm'],
                'color' => $p['color'],
                'sizes' => $p['sizes'],
                'brand_name' => $p['brand_name'],
                'manufacturer' => $p['manufacturer'],
                'state' => $p['state'],
                'district' => $p['district'],
                'address' => $p['address'],
                'mobile' => $p['mobile'],
                'description' => $p['description']
            ]);

            // Clear previous images if existing
            ProductImage::where('product_id', $product->id)->delete();

            foreach ($p['images'] as $img) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $img['path'],
                    'is_primary' => $img['primary']
                ]);
            }
        }
    }
}
