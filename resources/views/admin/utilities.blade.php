<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer Utilities | Bharat Tex 2026</title>
    
    <!-- Outfit Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
</head>
<body class="admin-login-body">

    <div class="login-card-container" style="max-width: 500px;">
        <!-- Header -->
        <div class="login-logo-header" style="margin-bottom: 24px;">
            <img src="{{ asset('images/logo.png') }}" alt="Bharat Tex 2026 Logo" class="login-logo" style="max-width: 120px;">
            <h2>Developer Utilities Core</h2>
            <p>Artisan Maintenance console helper</p>
        </div>

        <!-- Success Alert banner -->
        @if(session('success'))
            <div class="admin-alert success" style="margin-bottom: 20px; font-size: 0.85rem; padding: 10px 14px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Alert banner -->
        @if(session('error'))
            <div class="admin-login-error" style="margin-bottom: 20px; font-size: 0.85rem; padding: 10px 14px;">
                {{ session('error') }}
            </div>
        @endif

        <div style="display: flex; flex-direction: column; gap: 14px;">
            <!-- Clear Cache Form -->
            <form action="{{ route('utils.clearCache') }}" method="POST" style="width: 100%;">
                @csrf
                <button type="submit" class="admin-btn secondary" style="width: 100%; padding: 14px; background-color: #FEF3C7; color: #92400E; border: 1px solid #FCD34D;">🧹 Clear Cache</button>
            </form>

            <!-- Run Migrations Form -->
            <form action="{{ route('utils.runMigrations') }}" method="POST" style="width: 100%;">
                @csrf
                <button type="submit" class="admin-btn secondary" style="width: 100%; padding: 14px; background-color: #DBEAFE; color: #1E40AF; border: 1px solid #BFDBFE;">⚙️ Run Migrations</button>
            </form>

            <!-- Run Seeder Form -->
            <form action="{{ route('utils.runSeeder') }}" method="POST" onsubmit="return confirm('WARNING: This will seed default categories and products data. Continue?');" style="width: 100%;">
                @csrf
                <button type="submit" class="admin-btn secondary" style="width: 100%; padding: 14px; background-color: #D1FAE5; color: #065F46; border: 1px solid #A7F3D0;">🌱 Run Seeder</button>
            </form>

            <!-- Storage Link Form -->
            <form action="{{ route('utils.storageLink') }}" method="POST" style="width: 100%;">
                @csrf
                <button type="submit" class="admin-btn secondary" style="width: 100%; padding: 14px; background-color: #F3F4F6; color: #374151; border: 1px solid #E5E7EB;">🔗 Storage Link</button>
            </form>

            <!-- Composer Install Form -->
            <form action="{{ route('utils.composerInstall') }}" method="POST" style="width: 100%;" onsubmit="this.querySelector('button').disabled = true; this.querySelector('button').textContent = '📦 Running Composer Install... Please wait...';">
                @csrf
                <button type="submit" class="admin-btn secondary" style="width: 100%; padding: 14px; background-color: #E0F2FE; color: #0369A1; border: 1px solid #7DD3FC;">📦 Composer Install</button>
            </form>
        </div>

        <div style="text-align: center; margin-top: 24px; border-top: 1px solid var(--border-color); padding-top: 16px;">
            <a href="{{ route('welcome') }}" style="font-size: 0.85rem; color: var(--text-muted); text-decoration: none;">&larr; Back to Public Catalog</a>
        </div>
    </div>

</body>
</html>
