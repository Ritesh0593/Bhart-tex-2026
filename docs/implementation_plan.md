# Implementation Plan: Bharat Tex 2026 Mobile Catalog App

We will divide the development of this mobile-first Laravel application into **two separate, manageable phases**:
1. **Phase 1: Frontend & UI/UX (Mock Data)** - Creating all views, search UI, details layout, and premium Vanilla CSS styling.
2. **Phase 2: Backend, MySQL Database & PDF Download** - Setting up models, migrations, seeders, and PDF generation with Dompdf.

---

## Phase 1: Frontend & UI/UX (Mock Data)

### Focus
Building the mobile-first layouts, premium styling, category/product grid, and client-side searching so the app looks and feels exactly like the wireframes.

### Developer Action Prompt

```markdown
### Task List: Phase 1 (Frontend & UI/UX)

1. **Setup Directory & Basic Laravel Structure**:
   - Initialize a new Laravel project under `scratch/bharat-tex-2026`.
   - Setup basic web routes in `routes/web.php` for:
     - Splash/Welcome: `/`
     - Categories: `/categories`
     - Product Line: `/categories/{category}`
     - Product Details: `/products/{product}`

2. **Establish Design System (Vanilla CSS)**:
   - Create `public/css/app.css` with a responsive mobile-first container (max-width: 480px, centered on desktop, clean textile-like canvas texture background).
   - Set up CSS custom properties (variables) for color palettes: Expo Pink (`#D80073` or `#E6006B`), dark text (`#1A1A1A`), warm white borders, search input shadow, and clean card rounded corners.
   - Add micro-animations for button presses and card clicks.

3. **Develop Blade Views with Mock Data**:
   - **Splash View (`resources/views/welcome.blade.php`)**:
     - Large centered Bharat Tex logo, title text, and "Enter" button leading to `/categories`.
   - **Categories View (`resources/views/categories/index.blade.php`)**:
     - Back button, header logo, search bar ("Search category").
     - 2-column grid showing mock categories (Men's Wear, Knitwear, Women's Wear, Sportswear, Ethnic Wear, Winter Wear) with high-quality mock images/icons.
   - **Product Line View (`resources/views/products/index.blade.php`)**:
     - Breadcrumb navigation (`Home > Categories > Product line`).
     - Search input, 2-column grid displaying mock product cards (Premium Cotton Hoodie, Classic White Hoodie, etc.).
   - **Product Details View (`resources/views/products/show.blade.php`)**:
     - Breadcrumb navigation (`Home > Categories > Product line > Product details`).
     - Product main image with clickable thumbnails (e.g. front and side views).
     - Pricing tag (₹1,499) and detailed specification grid (Material: 100% Cotton, GSM: 320, Brand: Bharat Tex, Manufacturer, Contact Number, Full Pragati Maidan Address).
     - Full-width pink "Download" button.

4. **Add Interactive Features (Vanilla JS / AlpineJS)**:
   - Implement live client-side category/product filtering using JavaScript on the search input.
   - Add image switcher logic on the Product Details page when thumbnail images are clicked.
```

---

## Phase 2: Backend, MySQL Database & PDF Download

### Focus
Converting the mock views to dynamic database-driven pages, implementing search queries, and building the spec sheet PDF generator.

### Developer Action Prompt

```markdown
### Task List: Phase 2 (Backend & Database)

1. **Configure Database & Models**:
   - Setup MySQL configuration in `.env` (DB_CONNECTION=mysql, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD).
   - Create migrations for:
     - `categories` (id, name, slug, image_path)
     - `products` (id, category_id, name, slug, price, product_type, material, gsm, color, sizes, brand_name, manufacturer, state, district, address, mobile, description)
     - `product_images` (id, product_id, image_path, is_primary)
   - Define relationships:
     - `Category` hasMany `Product`.
     - `Product` belongsTo `Category` and hasMany `ProductImage`.

2. **Seeder Development**:
   - Write a database seeder (`DatabaseSeeder`) containing high-quality real-world data matching the Bharat Tex expo images (hoodies, knitwear, women's wear, sizes, manufacturers, Pragati Maidan stall details, mobile numbers).
   - Place sample images in `public/images/`.

3. **Refactor Routes & Controllers**:
   - Implement `CategoryController` and `ProductController`.
   - Query the MySQL database dynamically.
   - Enable backend-supported search queries (filtering results matching keyword search inputs).

4. **PDF Spec Sheet Generation**:
   - Install `barryvdh/laravel-dompdf` via Composer.
   - Create a clean, print-friendly PDF template (`resources/views/products/pdf.blade.php`) with:
     - Clear header branding of Bharat Tex 2026.
     - Organized table of specifications.
     - Manufacturer details, address, and mobile number.
   - Add a route `/products/{product}/download` to generate and download the PDF spec sheet when the user clicks the "Download" button.
```

---

## Verification Plan

### Manual Verification
- **Responsiveness**: Verify look and feel on Chrome DevTools mobile view (iPhone/Pixel sizes).
- **Search Flow**: Test typing in the search bar and verify cards filter instantly.
- **Product Gallery**: Test clicking details thumbnails to swap the main image.
- **Dynamic Content**: Seed different data and confirm it shows on Categories and Product Line pages.
- **PDF Generation**: Click the "Download" button and verify a clean formatted PDF containing all exact specifications is downloaded.
