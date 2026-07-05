@extends('layouts.app')

@section('title', 'Welcome | Bharat Tex 2026')

@section('content')
<div class="splash-wrapper">
    <!-- Top Spacer for centering -->
    <div></div>

    <!-- Hero Content matching Page 1 of PDF -->
    <div class="splash-hero">
        <img src="{{ asset('images/logo.png') }}" alt="Bharat Tex 2026 Logo" class="splash-logo">
        <h1 class="splash-title-exact">Welcome to Bharat Tex 2026</h1>
        <p class="splash-subtitle-exact">Global Textile Expo</p>
    </div>

    <!-- Enter Action Button -->
    <div class="splash-footer">
        <a href="{{ route('categories.index') }}" class="primary-btn-exact" id="enter-btn">Enter</a>
    </div>
</div>
@endsection
