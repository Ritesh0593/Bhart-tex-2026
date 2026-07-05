<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Show the Welcome Splash Screen.
     */
    public function welcome()
    {
        return view('welcome');
    }

    /**
     * List all textile categories from MySQL.
     */
    public function categories()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * List all products in a given category.
     */
    public function categoryProducts($category_slug)
    {
        $category = Category::where('slug', $category_slug)->firstOrFail();
        
        // Eager load primary image
        $products = Product::where('category_id', $category->id)->get()->map(function($product) {
            $primaryImg = $product->images()->where('is_primary', true)->first();
            
            // Format for Blade template compatibility
            return [
                'name' => $product->name,
                'slug' => $product->slug,
                'brand_name' => $product->brand_name,
                'price' => $product->price,
                'thumbnail' => $primaryImg ? $primaryImg->image_path : 'images/logo.png'
            ];
        });

        return view('products.index', compact('category', 'products'));
    }

    /**
     * Show details for a specific product.
     */
    public function productDetails($product_slug)
    {
        $productModel = Product::with(['category', 'images'])->where('slug', $product_slug)->firstOrFail();
        
        // Map model fields to match view arrays exactly
        $product = [
            'name' => $productModel->name,
            'slug' => $productModel->slug,
            'price' => $productModel->price,
            'product_type' => $productModel->product_type,
            'material' => $productModel->material,
            'gsm' => $productModel->gsm,
            'color' => $productModel->color,
            'sizes' => explode(', ', $productModel->sizes),
            'brand_name' => $productModel->brand_name,
            'manufacturer' => $productModel->manufacturer,
            'state' => $productModel->state,
            'district' => $productModel->district,
            'address' => $productModel->address,
            'mobile' => $productModel->mobile,
            'description' => $productModel->description,
            'images' => $productModel->images->pluck('image_path')->toArray()
        ];

        // Ensure we always have at least one image
        if (empty($product['images'])) {
            $product['images'] = ['images/logo.png'];
        }

        $category = $productModel->category;

        return view('products.show', compact('product', 'category'));
    }

    /**
     * Generate and download PDF spec sheet.
     */
    public function downloadPdf($product_slug)
    {
        $product = Product::with(['category', 'images'])->where('slug', $product_slug)->firstOrFail();
        
        // Load Dompdf view compiling local assets
        $pdf = Pdf::loadView('products.pdf', compact('product'));
        
        return $pdf->download($product->slug . '-specification-sheet.pdf');
    }
}
