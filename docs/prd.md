# Product Requirement Document (PRD)

## Project Overview: Bharat Tex 2026 Web Catalog App
**Bharat Tex 2026** is a mobile-first web catalog application designed to showcase textile products, apparel, and manufacturers participating in the Global Textile Expo. The application allows attendees, buyers, and exhibitors to explore textile categories, search for items, view detailed product information (including manufacturer contact details), and download product specification sheets.

---

## 1. User Journey & Screen Flows

Based on the provided wireframes, the application contains 4 primary screens optimized for mobile viewports:

### Screen 1: Splash / Welcome Page
* **Visuals**: A clean, premium textile-textured background (linen/canvas texture) featuring the official **Bharat Tex 2026** logo, a welcome tagline ("Welcome to Bharat Tex 2026 Global Textile Expo"), and a primary call-to-action (CTA) button.
* **Interactions**: Clicking the **"Enter"** button transitions the user to the Category Search screen.

### Screen 2: Category Listing & Search Page
* **Header**: Navigation bar containing a "Back" button, the logo, and a prominent search bar placeholder ("Search category").
* **Grid Layout**: A responsive 2-column card layout displaying major textile categories:
  1. Men's Wear
  2. Knitwear
  3. Women's Wear
  4. Sportswear
  5. Ethnic Wear
  6. Winter Wear
* **Interactions**:
  * Typing in the search bar dynamically filters categories.
  * Clicking a category card opens the Product Line listing for that category.

### Screen 3: Product Line (Products Listing) Page
* **Header & Search**: Retains the "Back" button, logo, and search input.
* **Breadcrumb Navigation**: Displays the current path: `Home > Categories > Product line` (helps with spatial orientation).
* **Grid Layout**: A 2-column card list of products belonging to the selected category (e.g., under Winter Wear or Apparel: "Premium Cotton Hoodie", "Classic White Hoodie", "Fleece Winter Hoodie", "Casual Everyday Hoodie").
* **Interactions**: Clicking a product card navigates to the detailed product page.

### Screen 4: Product Details Page
* **Header**: Contains the "Back" button and the logo.
* **Breadcrumb**: Displays `Home > Categories > Product line > Product details`.
* **Product Media Carousel/Gallery**: Large high-quality product image with smaller thumbnail selection options (e.g., Front View, Back View) below it.
* **Information Details**:
  * **Title & Price**: e.g., "Premium Cotton Hoodie" — ₹1,499.
  * **Specifications Table/List**:
    * Category (e.g., Apparel)
    * Product Type (e.g., Hooded Sweatshirt)
    * Material (e.g., 100% Premium Cotton Fleece)
    * Fabric GSM (e.g., 320 GSM)
    * Color (e.g., Maroon)
    * Sizes Available (S, M, L, XL, XXL)
    * Brand Name (e.g., Bharat Tex Collection)
    * Manufacturer (e.g., XYZ Textiles Pvt. Ltd.)
    * Location (State, District, Exhibition Address: e.g., Bharat Mandapam, Pragati Maidan, New Delhi)
    * Contact Mobile Number (e.g., +91 98765 43210)
  * **Product Description**: A paragraph describing the product's attributes.
* **Footer Call to Action (CTA)**: A full-width sticky or prominent **"Download"** button. This will generate and download a clean PDF sheet containing the product specs, manufacturer address, and QR code/contact information.

---

## 2. Key Features & Requirements

### Technical & Functional Requirements
1. **Search & Filter**: Fast client-side and server-side filtering of categories and product lists.
2. **Product PDF Catalog Download**: Generating a downloadable PDF layout representing the spec sheet for the specific product (using a PHP library like Dompdf or similar).
3. **Mobile-First Responsive Layout**: Tailwind-style modern responsive utility designs crafted in Vanilla CSS with glassmorphism touches, textile-inspired textured backgrounds, and high-quality margins/paddings fitting mobile devices.
4. **Dynamic Backend**: A Laravel controller structure feeding views with mock or MySQL database records so categories and products are dynamic.

---

## 3. Recommended Tech Stack
* **Framework**: Laravel 11.x (PHP 8.2+ or higher)
* **Database**: MySQL
* **Frontend**: Laravel Blade templates styled with high-end Vanilla CSS for maximum performance and direct layout control. 
* **PDF Engine**: `barryvdh/laravel-dompdf` for generating the PDF download file.

---

## 4. Proposed Database Schema

### `categories` Table
* `id` (Primary Key)
* `name` (string, e.g., "Men's Wear")
* `image_path` (string, path to category cover image)
* `slug` (string, unique url slug)

### `products` Table
* `id` (Primary Key)
* `category_id` (Foreign Key referencing categories)
* `name` (string, e.g., "Premium Cotton Hoodie")
* `price` (decimal/integer, e.g., 1499)
* `product_type` (string, e.g., "Hooded Sweatshirt")
* `material` (string, e.g., "100% Premium Cotton Fleece")
* `gsm` (integer, e.g., 320)
* `color` (string, e.g., "Maroon")
* `sizes` (string, comma-separated, e.g., "S,M,L,XL,XXL")
* `brand_name` (string, e.g., "Bharat Tex Collection")
* `manufacturer` (string)
* `state` (string)
* `district` (string)
* `address` (text)
* `mobile` (string)
* `description` (text)
* `slug` (string, unique url slug)

### `product_images` Table
* `id` (Primary Key)
* `product_id` (Foreign Key referencing products)
* `image_path` (string)
* `is_primary` (boolean)
