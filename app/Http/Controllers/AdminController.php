<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class AdminController extends Controller
{
    /**
     * Admin Dashboard index metrics.
     */
    public function dashboard()
    {
        $categoriesCount = Category::count();
        $productsCount = Product::count();
        return view('admin.dashboard', compact('categoriesCount', 'productsCount'));
    }

    /**
     * Categories CRUD: List all
     */
    public function categories()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Categories CRUD: Create form
     */
    public function createCategory()
    {
        $category = new Category();
        return view('admin.categories.form', compact('category'));
    }

    /**
     * Categories CRUD: Store
     */
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'cropped_image_data' => 'nullable|string'
        ]);

        $slug = Str::slug($request->name);

        // Ensure unique slug
        $count = Category::where('slug', 'like', $slug.'%')->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        if ($request->filled('cropped_image_data')) {
            $imagePath = $this->saveCroppedImage($request->cropped_image_data, 'images');
        } else {
            // Handle standard Image upload
            $imageName = time() . '-' . Str::random(5) . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        }

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'image_path' => $imagePath
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Categories CRUD: Edit form
     */
    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.form', compact('category'));
    }

    /**
     * Categories CRUD: Update
     */
    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'cropped_image_data' => 'nullable|string'
        ]);

        $data = ['name' => $request->name];

        if ($request->filled('cropped_image_data')) {
            if (file_exists(public_path($category->image_path))) {
                @unlink(public_path($category->image_path));
            }
            $data['image_path'] = $this->saveCroppedImage($request->cropped_image_data, 'images');
        } elseif ($request->hasFile('image')) {
            // Delete old file if exists
            if (file_exists(public_path($category->image_path))) {
                @unlink(public_path($category->image_path));
            }

            $imageName = time() . '-' . Str::random(5) . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image_path'] = 'images/' . $imageName;
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Categories CRUD: Destroy
     */
    public function destroyCategory($id)
    {
        $category = Category::findOrFail($id);

        // Delete associated image file
        if (file_exists(public_path($category->image_path))) {
            @unlink(public_path($category->image_path));
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }

    /**
     * Products CRUD: List all
     */
    public function products()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Products CRUD: Create form
     */
    public function createProduct()
    {
        $product = new Product();
        $categories = Category::all();
        return view('admin.products.form', compact('product', 'categories'));
    }

    /**
     * Products CRUD: Store
     */
    public function storeProduct(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'product_type' => 'required|string|max:255',
            'material' => 'required|string|max:255',
            'gsm' => 'required|integer|min:0',
            'color' => 'required|string|max:255',
            'sizes' => 'required|string|max:255',
            'brand_name' => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'address' => 'required|string',
            'mobile' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'cropped_image_data' => 'nullable|string',
            'secondary_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048'
        ]);

        $slug = Str::slug($request->name);
        $count = Product::where('slug', 'like', $slug.'%')->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $slug,
            'price' => $request->price,
            'product_type' => $request->product_type,
            'material' => $request->material,
            'gsm' => $request->gsm,
            'color' => $request->color,
            'sizes' => $request->sizes,
            'brand_name' => $request->brand_name,
            'manufacturer' => $request->manufacturer,
            'state' => $request->state,
            'district' => $request->district,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'description' => $request->description
        ]);

        if ($request->filled('cropped_image_data')) {
            $imagePath = $this->saveCroppedImage($request->cropped_image_data, 'images');
        } else {
            // Upload and create primary image
            $imageName = time() . '-' . Str::random(5) . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        }

        ProductImage::create([
            'product_id' => $product->id,
            'image_path' => $imagePath,
            'is_primary' => true
        ]);

        // Upload secondary images
        if ($request->hasFile('secondary_images')) {
            foreach ($request->file('secondary_images') as $secFile) {
                $secName = time() . '-' . Str::random(8) . '.' . $secFile->extension();
                $secFile->move(public_path('images'), $secName);
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'images/' . $secName,
                    'is_primary' => false
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Products CRUD: Edit form
     */
    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.form', compact('product', 'categories'));
    }

    /**
     * Products CRUD: Update
     */
    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'product_type' => 'required|string|max:255',
            'material' => 'required|string|max:255',
            'gsm' => 'required|integer|min:0',
            'color' => 'required|string|max:255',
            'sizes' => 'required|string|max:255',
            'brand_name' => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'address' => 'required|string',
            'mobile' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'cropped_image_data' => 'nullable|string',
            'secondary_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048'
        ]);

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'product_type' => $request->product_type,
            'material' => $request->material,
            'gsm' => $request->gsm,
            'color' => $request->color,
            'sizes' => $request->sizes,
            'brand_name' => $request->brand_name,
            'manufacturer' => $request->manufacturer,
            'state' => $request->state,
            'district' => $request->district,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'description' => $request->description
        ]);

        if ($request->filled('cropped_image_data')) {
            // Get previous primary image
            $primaryImg = ProductImage::where('product_id', $product->id)->where('is_primary', true)->first();
            if ($primaryImg) {
                if (file_exists(public_path($primaryImg->image_path))) {
                    @unlink(public_path($primaryImg->image_path));
                }
                $primaryImg->delete();
            }

            $imagePath = $this->saveCroppedImage($request->cropped_image_data, 'images');
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $imagePath,
                'is_primary' => true
            ]);
        } elseif ($request->hasFile('image')) {
            // Get previous primary image
            $primaryImg = ProductImage::where('product_id', $product->id)->where('is_primary', true)->first();
            if ($primaryImg) {
                if (file_exists(public_path($primaryImg->image_path))) {
                    @unlink(public_path($primaryImg->image_path));
                }
                $primaryImg->delete();
            }

            // Upload new
            $imageName = time() . '-' . Str::random(5) . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;

            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $imagePath,
                'is_primary' => true
            ]);
        }

        // Upload secondary images
        if ($request->hasFile('secondary_images')) {
            foreach ($request->file('secondary_images') as $secFile) {
                $secName = time() . '-' . Str::random(8) . '.' . $secFile->extension();
                $secFile->move(public_path('images'), $secName);
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'images/' . $secName,
                    'is_primary' => false
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Products CRUD: Destroy
     */
    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);

        // Delete images
        $images = ProductImage::where('product_id', $product->id)->get();
        foreach ($images as $img) {
            if (file_exists(public_path($img->image_path))) {
                @unlink(public_path($img->image_path));
            }
            $img->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    /**
     * Show Admin Login Form.
     */
    public function showLogin()
    {
        if (session()->has('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    /**
     * Process Admin Login submission.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $expectedUsername = env('ADMIN_USERNAME', 'admin');
        $expectedPassword = env('ADMIN_PASSWORD', 'admin123');

        if ($request->username === $expectedUsername && $request->password === $expectedPassword) {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard')->with('success', 'Logged in successfully.');
        }

        return back()->withErrors(['login_error' => 'Invalid username or password.'])->withInput();
    }

    /**
     * Terminate Admin Session / Logout.
     */
    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }

    /**
     * Delete secondary product image.
     */
    public function deleteProductImage($id)
    {
        $img = ProductImage::findOrFail($id);
        
        if ($img->is_primary) {
            return response()->json(['success' => false, 'message' => 'Cannot delete primary image.'], 400);
        }

        if (file_exists(public_path($img->image_path))) {
            @unlink(public_path($img->image_path));
        }
        $img->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Decodes base64 image data and writes to public/images/
     */
    private function saveCroppedImage($base64Data, $folder = 'images')
    {
        if (preg_match('/^data:image\/(\w+);base64,/', $base64Data, $type)) {
            $base64Data = substr($base64Data, strpos($base64Data, ',') + 1);
            $type = strtolower($type[1]);

            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png', 'webp'])) {
                throw new \Exception('Invalid image type');
            }
            $base64Data = base64_decode($base64Data);
            if ($base64Data === false) {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception('Did not match data URI with image data');
        }

        $imageName = time() . '-' . Str::random(8) . '.' . $type;
        $filePath = public_path($folder . '/' . $imageName);

        if (!file_exists(public_path($folder))) {
            mkdir(public_path($folder), 0755, true);
        }

        file_put_contents($filePath, $base64Data);

        return $folder . '/' . $imageName;
    }

    /**
     * Show the standalone developer utilities page.
     */
    public function showUtilities()
    {
        return view('admin.utilities');
    }

    /**
     * Clear application cache, config, route, and view caches.
     */
    public function clearCache()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        return redirect()->route('utils.dashboard')->with('success', 'Application cache, configurations, routes, and compiled views cleared successfully!');
    }

    /**
     * Run database migrations.
     */
    public function runMigrations()
    {
        try {
            Artisan::call('migrate', ['--force' => true]);
            $output = Artisan::output();
            return redirect()->route('utils.dashboard')->with('success', 'Migrations completed successfully! Log: ' . trim($output));
        } catch (\Exception $e) {
            return redirect()->route('utils.dashboard')->with('error', 'Migration failed: ' . $e->getMessage());
        }
    }

    /**
     * Run database seeders.
     */
    public function runSeeder()
    {
        try {
            Artisan::call('db:seed', ['--force' => true]);
            $output = Artisan::output();
            return redirect()->route('utils.dashboard')->with('success', 'Database seeders completed successfully! Log: ' . trim($output));
        } catch (\Exception $e) {
            return redirect()->route('utils.dashboard')->with('error', 'Seeding failed: ' . $e->getMessage());
        }
    }

    /**
     * Run storage link command.
     */
    public function storageLink()
    {
        try {
            Artisan::call('storage:link');
            $output = Artisan::output();
            return redirect()->route('utils.dashboard')->with('success', 'Storage link created successfully! Log: ' . trim($output));
        } catch (\Exception $e) {
            return redirect()->route('utils.dashboard')->with('error', 'Storage link command failed: ' . $e->getMessage());
        }
    }

    /**
     * Run composer install command.
     */
    public function runComposerInstall()
    {
        try {
            // Adjust memory limits and time limits
            ini_set('memory_limit', '512M');
            set_time_limit(300);

            // Bind composer home directory inside public/writable space
            $composerHome = base_path('storage/app/composer');
            if (!file_exists($composerHome)) {
                mkdir($composerHome, 0755, true);
            }

            // Run process in codebase root (checking local binaries or global fallback)
            $phpBinary = file_exists('/opt/lampp/bin/php') ? '/opt/lampp/bin/php' : 'php';
            $command = file_exists(base_path('composer.phar')) 
                ? $phpBinary . ' composer.phar install --no-dev --optimize-autoloader'
                : 'composer install --no-dev --optimize-autoloader';

            $fullCommand = "COMPOSER_HOME=\"{$composerHome}\" HOME=\"{$composerHome}\" {$command}";

            $env = [
                'COMPOSER_HOME' => $composerHome,
                'HOME' => $composerHome,
            ];

            $process = Process::fromShellCommandline($fullCommand, base_path(), $env);
            $process->setTimeout(300);
            $process->run();

            if ($process->isSuccessful()) {
                $output = $process->getOutput();
                return redirect()->route('utils.dashboard')->with('success', 'Composer packages installed successfully! Log: ' . trim($output));
            } else {
                $error = $process->getErrorOutput();
                return redirect()->route('utils.dashboard')->with('error', 'Composer install failed: ' . trim($error));
            }
        } catch (\Exception $e) {
            return redirect()->route('utils.dashboard')->with('error', 'Composer installation crashed: ' . $e->getMessage());
        }
    }
}
