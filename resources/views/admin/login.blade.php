<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Bharat Tex 2026</title>
    
    <!-- Outfit Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
</head>
<body class="admin-login-body">

    <div class="login-card-container">
        <!-- Logo Header -->
        <div class="login-logo-header">
            <img src="{{ asset('images/logo.png') }}" alt="Bharat Tex 2026 Logo" class="login-logo">
            <h2>Admin Portal Login</h2>
            <p>Access the management dashboard and specs editor</p>
        </div>

        <!-- Success Notification -->
        @if(session('success'))
            <div class="admin-alert success" style="margin-bottom: 16px; padding: 10px 14px; font-size: 0.85rem;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Notifications -->
        @if($errors->has('login_error'))
            <div class="admin-login-error">
                {{ $errors->first('login_error') }}
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf

            <!-- Username Field -->
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required placeholder="Enter username" autofocus>
                @error('username')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="form-group" style="margin-bottom: 24px;">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Enter password">
                @error('password')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <!-- Login Trigger -->
            <button type="submit" class="primary-btn-exact" style="width: 100%; border: none;">Sign In</button>
        </form>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('welcome') }}" style="font-size: 0.85rem; color: var(--text-muted); text-decoration: none;">&larr; Back to Public Catalog</a>
        </div>
    </div>

</body>
</html>
