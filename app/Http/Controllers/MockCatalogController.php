<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MockCatalogController extends Controller
{
    // High-quality mock categories matching Page 2 & 5 of bharat.pdf
    private function getCategories()
    {
        return [
            [
                'id' => 1,
                'name' => "Men's Wear",
                'slug' => 'mens-wear',
                'image' => '/images/hoodie_red.png',
                'description' => 'Premium shirts, trousers, and ethnic fusion wear.'
            ],
            [
                'id' => 2,
                'name' => 'Knitwear',
                'slug' => 'knitwear',
                'image' => '/images/shirt_black.webp',
                'description' => 'Cozy sweaters, cards, and knit accessories.'
            ],
            [
                'id' => 3,
                'name' => "Women's Wear",
                'slug' => 'womens-wear',
                'image' => '/images/dress_yellow.webp',
                'description' => 'Designer sarees, suits, and modern western silhouettes.'
            ],
            [
                'id' => 4,
                'name' => 'Sportswear',
                'slug' => 'sportswear',
                'image' => '/images/shirt_blue_hanger.webp',
                'description' => 'High-performance activewear and breathable athletics.'
            ],
            [
                'id' => 5,
                'name' => 'Ethnic Wear',
                'slug' => 'ethnic-wear',
                'image' => '/images/hoodie_red.png',
                'description' => 'Traditional kurtas, sherwanis, and festive handloom textiles.'
            ],
            [
                'id' => 6,
                'name' => 'Winter Wear',
                'slug' => 'winter-wear',
                'image' => '/images/shirt_black.webp',
                'description' => 'Heavy GSM hoodies, jackets, and thermal wear.'
            ],
        ];
    }

    // High-quality mock products matching Page 3 & 4 of bharat.pdf
    private function getProducts()
    {
        return [
            // Winter Wear
            [
                'id' => 1,
                'category_slug' => 'winter-wear',
                'name' => 'Premium Cotton Hoodie',
                'slug' => 'premium-cotton-hoodie',
                'price' => 1499,
                'product_type' => 'Hooded Sweatshirt',
                'material' => '100% Premium Cotton Fleece',
                'gsm' => 320,
                'color' => 'Maroon',
                'sizes' => ['S', 'M', 'L', 'XL', 'XXL'],
                'brand_name' => 'Bharat Tex Collection',
                'manufacturer' => 'XYZ Textiles Pvt. Ltd.',
                'state' => 'Delhi',
                'district' => 'New Delhi',
                'address' => 'Bharat Mandapam Exhibition Hall, Pragati Maidan, New Delhi – 110001',
                'mobile' => '+91 98765 43210',
                'description' => 'Premium-quality cotton hoodie crafted for comfort and durability.',
                'images' => ['/images/hoodie_red.png', '/images/hoodie_red.png'], // Show red hoodie on details page (Page 4 details)
                'thumbnail' => '/images/sweater_blue.webp' // Show blue hoodie on list card (Page 3 grid)
            ],
            [
                'id' => 2,
                'category_slug' => 'winter-wear',
                'name' => 'Classic White Hoodie',
                'slug' => 'classic-white-hoodie',
                'price' => 1299,
                'product_type' => 'Hooded Sweatshirt',
                'material' => '80% Cotton, 20% Polyester',
                'gsm' => 300,
                'color' => 'White',
                'sizes' => ['M', 'L', 'XL'],
                'brand_name' => 'Bharat Tex Collection',
                'manufacturer' => 'ABC Knitwear',
                'state' => 'Punjab',
                'district' => 'Ludhiana',
                'address' => 'Stall 4, Hall 2, Bharat Mandapam, Pragati Maidan, New Delhi',
                'mobile' => '+91 98765 43211',
                'description' => 'A clean, timeless aesthetic white hoodie designed for everyday lifestyle.',
                'images' => ['/images/hoodie_white.webp'],
                'thumbnail' => '/images/hoodie_white.webp'
            ],
            [
                'id' => 3,
                'category_slug' => 'winter-wear',
                'name' => 'Fleece Winter Hoodie',
                'slug' => 'fleece-winter-hoodie',
                'price' => 1699,
                'product_type' => 'Hooded Sweatshirt',
                'material' => '100% Polyester Fleece',
                'gsm' => 340,
                'color' => 'Navy Blue',
                'sizes' => ['S', 'M', 'L', 'XL'],
                'brand_name' => 'WarmTex',
                'manufacturer' => 'Ludhiana Woolens',
                'state' => 'Punjab',
                'district' => 'Ludhiana',
                'address' => 'Stall 18, Hall 3, Bharat Mandapam, Pragati Maidan, New Delhi',
                'mobile' => '+91 98765 43212',
                'description' => 'Engineered for extreme winters with brush-back soft fleece.',
                'images' => ['/images/hoodie_red.png'],
                'thumbnail' => '/images/hoodie_red.png'
            ],
            [
                'id' => 4,
                'category_slug' => 'winter-wear',
                'name' => 'Casual Everyday Hoodie',
                'slug' => 'casual-everyday-hoodie',
                'price' => 999,
                'product_type' => 'Hooded Sweatshirt',
                'material' => '60% Cotton, 40% Polyester',
                'gsm' => 280,
                'color' => 'Black',
                'sizes' => ['M', 'L', 'XL', 'XXL'],
                'brand_name' => 'DailyWear',
                'manufacturer' => 'Surat Fabrics',
                'state' => 'Gujarat',
                'district' => 'Surat',
                'address' => 'Stall 9, Hall 4, Bharat Mandapam, Pragati Maidan, New Delhi',
                'mobile' => '+91 98765 43213',
                'description' => 'Lightweight black hoodie perfect for mild winter days or layering.',
                'images' => ['/images/hoodie_brown.webp'],
                'thumbnail' => '/images/hoodie_brown.webp'
            ],

            // Men's Wear (Fallbacks using exact assets if clicked)
            [
                'id' => 5,
                'category_slug' => 'mens-wear',
                'name' => 'Premium Casual Hoodie',
                'slug' => 'premium-casual-hoodie',
                'price' => 1499,
                'product_type' => 'Hooded Sweatshirt',
                'material' => '100% Cotton',
                'gsm' => 320,
                'color' => 'Red',
                'sizes' => ['S', 'M', 'L', 'XL'],
                'brand_name' => 'Bharat Tex Collection',
                'manufacturer' => 'XYZ Textiles Pvt. Ltd.',
                'state' => 'Delhi',
                'district' => 'New Delhi',
                'address' => 'Bharat Mandapam, Pragati Maidan, New Delhi',
                'mobile' => '+91 98765 43210',
                'description' => 'Premium casual wear red hoodie.',
                'images' => ['/images/hoodie_red.png'],
                'thumbnail' => '/images/hoodie_red.png'
            ]
        ];
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function categories()
    {
        $categories = $this->getCategories();
        return view('categories.index', compact('categories'));
    }

    public function categoryProducts($category_slug)
    {
        $categories = $this->getCategories();
        $category = collect($categories)->firstWhere('slug', $category_slug);
        
        if (!$category) {
            abort(404, 'Category not found');
        }

        $products = collect($this->getProducts())->where('category_slug', $category_slug)->values()->all();
        return view('products.index', compact('category', 'products'));
    }

    public function productDetails($product_slug)
    {
        $products = $this->getProducts();
        $product = collect($products)->firstWhere('slug', $product_slug);

        if (!$product) {
            abort(404, 'Product not found');
        }

        $categories = $this->getCategories();
        $category = collect($categories)->firstWhere('slug', $product['category_slug']);

        return view('products.show', compact('product', 'category'));
    }
}
