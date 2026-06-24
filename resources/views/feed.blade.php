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
</style>

<div class="relative min-h-[calc(100vh-140px)] py-12 bg-slate-50 overflow-hidden">
    <!-- Background Accents with yellow palette -->
    <div class="absolute top-10 left-10 w-72 h-72 bg-glow-yellow-1 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-glow-yellow-2 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10 animate-fade-in-up">

        <!-- Livewire Component -->
        @livewire('home-feed')
    </div>
</div>
@endsection