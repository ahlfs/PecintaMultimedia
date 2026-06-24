@extends('layouts.app')

@section('title', 'Eksplorasi - GudangMeme')

@section('content')
<style>
    /* Custom Yellow Palette Styles */
    .bg-brand-primary { background-color: #e69b00 !important; }
    .bg-brand-accent { background-color: #e6b400 !important; }
    .text-brand-primary { color: #e69b00 !important; }
    .text-brand-accent { color: #e6b400 !important; }
    .border-brand-primary { border-color: #e69b00 !important; }
    .border-brand-accent { border-color: #e6b400 !important; }
    .focus\\:ring-brand-accent\\/10:focus { --tw-ring-color: rgba(230, 180, 0, 0.1); }
    .focus\\:ring-brand-accent\\/20:focus { --tw-ring-color: rgba(230, 180, 0, 0.2); }
    .focus\\:border-brand-accent:focus { border-color: #e6b400; }
    .group-focus-within\\:text-brand-accent group-focus-within\:text-brand-accent { color: #e6b400; }
    .bg-brand-accent\\/10 { background-color: rgba(230, 180, 0, 0.1); }
    .bg-brand-accent\\/20 { background-color: rgba(230, 180, 0, 0.2); }
    .text-brand-accent\\/80 { color: rgba(230, 180, 0, 0.8); }
    
    /* Glowing border effect for main card */
    .glowing-border {
        position: relative;
        border: 1px solid rgba(230, 180, 0, 0.2);
        box-shadow: 0 0 40px rgba(230, 155, 0, 0.15), 
                    0 0 80px rgba(230, 180, 0, 0.1),
                    inset 0 1px 0 rgba(255, 255, 255, 0.6);
    }
    
    .glowing-border::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg, #e69b00, #e6b400, #e6cc00, #e5de00, #e6b400, #e69b00);
        border-radius: inherit;
        z-index: -1;
        filter: blur(20px);
        opacity: 0.4;
        animation: glowRotate 8s linear infinite;
        background-size: 400% 400%;
    }
    
    @keyframes glowRotate {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    /* Button glow effects */
    .btn-glow-yellow {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn-glow-yellow::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }
    
    .btn-glow-yellow:hover::before {
        left: 100%;
    }
    
    .btn-glow-yellow:hover {
        box-shadow: 0 0 30px rgba(230, 155, 0, 0.4),
                    0 0 60px rgba(230, 180, 0, 0.2);
        transform: translateY(-2px);
    }
    
    .btn-glow-yellow:active {
        transform: translateY(0);
    }
    
    /* Input focus glow */
    .input-glow-yellow:focus {
        box-shadow: 0 0 0 4px rgba(230, 180, 0, 0.1),
                    0 0 20px rgba(230, 155, 0, 0.15);
    }
    
    /* Background glow shapes with yellow */
    .bg-glow-yellow-1 {
        background: radial-gradient(circle, rgba(230, 155, 0, 0.08) 0%, transparent 70%);
    }
    
    .bg-glow-yellow-2 {
        background: radial-gradient(circle, rgba(230, 180, 0, 0.12) 0%, transparent 70%);
    }
    
    /* Gradient text */
    .text-gradient-yellow {
        background: linear-gradient(135deg, #e69b00 0%, #e6b400 50%, #e6cc00 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    /* Card section hover */
    .card-section-hover {
        transition: all 0.3s ease;
    }
    
    .card-section-hover:hover {
        box-shadow: 0 4px 20px rgba(230, 155, 0, 0.08);
    }

    /* Footer - All text white */
    footer, footer *, footer a, footer p, footer span, footer div {
        color: #ffffff !important;
    }
    
    footer a:hover {
        color: #f0f0f0 !important;
    }

    /* ============================================
       RESPONSIVE MOBILE GRID FOR HOME-FEED
       ============================================ */
    
    /* Override untuk Livewire home-feed component */
    .feed-grid {
        display: grid;
        gap: 0.75rem;
        width: 100%;
    }
    
    /* Mobile First - 2 kolom di HP */
    .feed-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    /* Tablet - 3 kolom */
    @media (min-width: 640px) {
        .feed-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }
    }
    
    /* Desktop kecil - 4 kolom */
    @media (min-width: 1024px) {
        .feed-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }
    
    /* Desktop besar - 5 kolom */
    @media (min-width: 1280px) {
        .feed-grid {
            grid-template-columns: repeat(5, 1fr);
        }
    }
    
    /* Masonry layout untuk feed */
    .feed-masonry {
        column-count: 2;
        column-gap: 0.75rem;
    }
    
    @media (min-width: 640px) {
        .feed-masonry {
            column-count: 3;
            column-gap: 1rem;
        }
    }
    
    @media (min-width: 1024px) {
        .feed-masonry {
            column-count: 4;
        }
    }
    
    @media (min-width: 1280px) {
        .feed-masonry {
            column-count: 5;
        }
    }
    
    /* Feed card items */
    .feed-card {
        break-inside: avoid;
        margin-bottom: 0.75rem;
        border-radius: 1rem;
        overflow: hidden;
        background: white;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    @media (min-width: 640px) {
        .feed-card {
            margin-bottom: 1rem;
            border-radius: 1.25rem;
        }
    }
    
    .feed-card:hover {
        box-shadow: 0 10px 30px rgba(230, 155, 0, 0.15);
        transform: translateY(-2px);
    }
    
    .feed-card img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .feed-card:hover img {
        transform: scale(1.03);
    }
    
    /* Container padding responsive */
    .feed-container {
        padding: 0.5rem;
    }
    
    @media (min-width: 640px) {
        .feed-container {
            padding: 1rem;
        }
    }
    
    @media (min-width: 1024px) {
        .feed-container {
            padding: 1.5rem;
        }
    }
    
    /* Search & Filter bar responsive */
    .feed-filter-bar {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }
    
    @media (min-width: 640px) {
        .feed-filter-bar {
            flex-direction: row;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }
    }
    
    /* Loading skeleton responsive */
    .feed-skeleton {
        width: 100%;
        aspect-ratio: 1;
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
        border-radius: 1rem;
    }
    
    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }
    
    /* Empty state responsive */
    .feed-empty-state {
        padding: 2rem 1rem;
        text-align: center;
    }
    
    @media (min-width: 640px) {
        .feed-empty-state {
            padding: 3rem 2rem;
        }
    }
    
    /* Post info overlay responsive */
    .feed-card-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 0.75rem;
        background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .feed-card:hover .feed-card-overlay {
        opacity: 1;
    }
    
    .feed-card-overlay h4 {
        color: white;
        font-size: 0.75rem;
        font-weight: bold;
        line-height: 1.2;
    }
    
    @media (min-width: 640px) {
        .feed-card-overlay {
            padding: 1rem;
        }
        .feed-card-overlay h4 {
            font-size: 0.875rem;
        }
    }
    
    /* Like button responsive */
    .feed-like-btn {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        opacity: 0;
    }
    
    @media (min-width: 640px) {
        .feed-like-btn {
            width: 2.5rem;
            height: 2.5rem;
            top: 0.75rem;
            right: 0.75rem;
        }
    }
    
    .feed-card:hover .feed-like-btn {
        opacity: 1;
    }
    
    /* Infinite scroll / pagination responsive */
    .feed-pagination {
        margin-top: 2rem;
        padding: 1rem;
        text-align: center;
    }
    
    @media (min-width: 640px) {
        .feed-pagination {
            margin-top: 3rem;
            padding: 1.5rem;
        }
    }
    
    /* Category/Tag pills responsive */
    .feed-tag-pill {
        display: inline-flex;
        align-items: center;
        padding: 0.375rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        white-space: nowrap;
        transition: all 0.3s ease;
    }
    
    @media (min-width: 640px) {
        .feed-tag-pill {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }
    }
    
    /* Header title responsive */
    .feed-header-title {
        font-size: 1.5rem;
        line-height: 1.2;
    }
    
    @media (min-width: 640px) {
        .feed-header-title {
            font-size: 2rem;
        }
    }
    
    @media (min-width: 1024px) {
        .feed-header-title {
            font-size: 2.5rem;
        }
    }
    
    /* Prevent images from being too large on mobile */
    .feed-card img {
        max-width: 100%;
        height: auto;
    }
    
    /* Aspect ratio variants for variety */
    .feed-card.aspect-square img {
        aspect-ratio: 1/1;
    }
    
    .feed-card.aspect-portrait img {
        aspect-ratio: 3/4;
    }
    
    .feed-card.aspect-landscape img {
        aspect-ratio: 4/3;
    }
    
    /* Mobile touch improvements */
    @media (max-width: 639px) {
        .feed-card {
            cursor: pointer;
        }
        
        .feed-card:active {
            transform: scale(0.98);
        }
        
        /* Always show like button on mobile (no hover) */
        .feed-like-btn {
            opacity: 1 !important;
        }
        
        /* Always show overlay on mobile */
        .feed-card-overlay {
            opacity: 1 !important;
            background: linear-gradient(to top, rgba(0,0,0,0.5), transparent);
        }
    }
</style>

<div class="relative min-h-[calc(100vh-140px)] py-6 sm:py-12 bg-slate-50 overflow-hidden">
    <!-- Background Accents with yellow palette -->
    <div class="absolute top-10 left-10 w-72 h-72 bg-glow-yellow-1 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-glow-yellow-2 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-[1600px] mx-auto px-3 sm:px-6 lg:px-8 relative z-10 animate-fade-in-up feed-container">

        <!-- Livewire Component -->
        @livewire('home-feed')
    </div>
</div>

@push('scripts')
<script>
    // Auto-resize images on load to prevent layout shift
    document.addEventListener('DOMContentLoaded', function() {
        const feedImages = document.querySelectorAll('.feed-card img');
        feedImages.forEach(img => {
            if (img.complete) {
                adjustImageSize(img);
            } else {
                img.addEventListener('load', () => adjustImageSize(img));
            }
        });
    });

    function adjustImageSize(img) {
        const card = img.closest('.feed-card');
        if (!card) return;
        
        const aspectRatio = img.naturalWidth / img.naturalHeight;
        
        // Assign aspect ratio class for visual variety
        if (aspectRatio > 1.2) {
            card.classList.add('aspect-landscape');
        } else if (aspectRatio < 0.8) {
            card.classList.add('aspect-portrait');
        } else {
            card.classList.add('aspect-square');
        }
    }

    // Lazy loading with Intersection Observer for better mobile performance
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    observer.unobserve(img);
                }
            });
        }, {
            rootMargin: '100px',
            threshold: 0.01
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
</script>
@endpush
@endsection