<?php
$seo_title = $seo_title ?? 'Healing Touch Hospital';
$seo_description = $seo_description ?? 'Compassionate and accessible healthcare with trusted specialists and modern facilities.';
$seo_keywords = $seo_keywords ?? 'Hospital, Healthcare, Doctors, Purnea';
$active_page = $active_page ?? 'home';

function is_active($page, $active_page) {
    return $page === $active_page ? 'text-beige-700 bg-beige-50/60' : 'text-gray-600 hover:text-beige-700 hover:bg-beige-50/60';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Advanced SEO -->
    <title><?php echo isset($seo_title) ? htmlspecialchars($seo_title) : 'Healing Touch Hospital | Best Healthcare in Purnea'; ?></title>
    <meta name="description" content="<?php echo isset($seo_description) ? htmlspecialchars($seo_description) : 'Healing Touch Hospital offers top-quality medical care in Purnea. Book your appointment online with our expert doctors today.'; ?>">
    <meta name="keywords" content="<?php echo isset($seo_keywords) ? htmlspecialchars($seo_keywords) : 'Hospital in Purnea, best doctor in purnea, healing touch, medical care, healthcare, clinic, book appointment'; ?>">
    <meta name="author" content="Healing Touch Hospital">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://healingtouch.com/">
    <meta property="og:title" content="<?php echo isset($seo_title) ? htmlspecialchars($seo_title) : 'Healing Touch Hospital | Purnea'; ?>">
    <meta property="og:description" content="<?php echo isset($seo_description) ? htmlspecialchars($seo_description) : 'Best medical care and specialist doctors in Purnea. Book your appointment online.'; ?>">
    <meta property="og:image" content="https://healingtouch.com/assets/images/hospital-in-purnea-hero.jpg">
    <meta property="og:site_name" content="Healing Touch Hospital">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Compiled CSS -->
    <link rel="stylesheet" href="/assets/css/app.css">
    
    <style>
        .text-beige-700 { color: #0f766e !important; }
        .text-beige-600 { color: #0d9488 !important; }
        .text-beige-400 { color: #2dd4bf !important; }
        .text-beige-200 { color: #99f6e4 !important; }
        .text-beige-100 { color: #ccfbf1 !important; }
        .text-beige-900 { color: #134e4a !important; }
        .text-beige-800 { color: #115e59 !important; }
        
        .bg-beige-600 { background-color: #0d9488 !important; }
        .bg-beige-700 { background-color: #0f766e !important; }
        .bg-beige-500 { background-color: #14b8a6 !important; }
        .bg-beige-100 { background-color: #ccfbf1 !important; }
        .bg-beige-50 { background-color: #f0fdfa !important; }
        .bg-beige-200 { background-color: #99f6e4 !important; }
        
        .border-beige-600 { border-color: #0d9488 !important; }
        .border-beige-200 { border-color: #99f6e4 !important; }
        .border-beige-100 { border-color: #ccfbf1 !important; }
        .border-beige-300 { border-color: #5eead4 !important; }
        .border-beige-400 { border-color: #2dd4bf !important; }
        
        .hover\:text-beige-700:hover { color: #0f766e !important; }
        .hover\:text-beige-800:hover { color: #115e59 !important; }
        .hover\:bg-beige-700:hover { background-color: #0f766e !important; }
        .hover\:bg-beige-50\/60:hover { background-color: rgba(240, 253, 250, 0.6) !important; }
        .hover\:bg-beige-50:hover { background-color: #f0fdfa !important; }
        .hover\:bg-beige-200:hover { background-color: #99f6e4 !important; }
        .hover\:border-beige-200:hover { border-color: #99f6e4 !important; }
        
        .bg-beige-50\/60 { background-color: rgba(240, 253, 250, 0.6) !important; }
        
        button:disabled, input:disabled, select:disabled {
            opacity: 0.5 !important;
            cursor: not-allowed !important;
            pointer-events: none;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <header id="main-header" class="fixed w-full top-0 z-50 transition-all duration-200 bg-white/90 backdrop-blur-sm border-b border-gray-100 py-4">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a href="/index.php" class="flex items-center space-x-3 group">
                        <!-- Application Logo -->
                        <img src="/assets/images/healingTouchLogo.jpeg" alt="Healing Touch Logo" class="h-10 w-10 shrink-0 object-cover rounded-full transition-transform duration-150 group-hover:scale-105">
                        <div class="leading-none">
                            <div class="font-black text-lg sm:text-xl text-gray-800 tracking-tight leading-none group-hover:text-beige-700 transition-colors">
                                <span class="text-beige-700">Healing</span> Touch
                            </div>
                            <p class="text-[10px] sm:text-[11px] text-gray-400 font-bold uppercase tracking-widest mt-1">Hospital (Purnea)</p>
                        </div>
                    </a>
                </div>

                <nav class="hidden lg:flex items-center space-x-1">
                    <a href="/index.php" class="px-3 py-2 rounded-md text-[13px] font-semibold transition-colors duration-150 <?php echo is_active('home', $active_page); ?>">Home</a>
                    <a href="/services.php" class="px-3 py-2 rounded-md text-[13px] font-semibold transition-colors duration-150 <?php echo is_active('services', $active_page); ?>">Services</a>
                    <a href="/our-doctors.php" class="px-3 py-2 rounded-md text-[13px] font-semibold transition-colors duration-150 <?php echo is_active('doctors', $active_page); ?>">Our Doctors</a>
                    <a href="/about-us.php" class="px-3 py-2 rounded-md text-[13px] font-semibold transition-colors duration-150 <?php echo is_active('about', $active_page); ?>">About Us</a>
                    <a href="/gallery.php" class="px-3 py-2 rounded-md text-[13px] font-semibold transition-colors duration-150 <?php echo is_active('gallery', $active_page); ?>">Gallery</a>
                    <a href="/careers.php" class="px-3 py-2 rounded-md text-[13px] font-semibold transition-colors duration-150 <?php echo is_active('careers', $active_page); ?>">Careers</a>
                    <a href="/contact-us.php" class="px-3 py-2 rounded-md text-[13px] font-semibold transition-colors duration-150 <?php echo is_active('contact', $active_page); ?>">Contact</a>
                </nav>

                <div class="hidden lg:block">
                    <a href="<?php echo htmlspecialchars($LARAVEL_BOOKING_URL); ?>" class="bg-beige-600 hover:bg-beige-700 text-white px-4 py-2.5 rounded-md transition-colors duration-150 border border-beige-600 font-bold text-[11px] tracking-wide uppercase flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" /></svg>
                        Book Appointment
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="lg:hidden fixed bottom-0 inset-x-0 z-50 bg-white shadow-[0_-4px_15px_rgba(0,0,0,0.03)] border-t border-gray-100 pb-safe">
        <div class="grid grid-cols-4 gap-1 px-2.5 py-1.5 pb-2">
            <a href="/index.php" class="flex flex-col items-center justify-center rounded-md py-1.5 transition-colors duration-150 text-gray-500 hover:text-beige-700">
                <span class="leading-none">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10.5L12 3l9 7.5M5.25 9.75V21h13.5V9.75" /></svg>
                </span>
                <span class="text-[10px] font-bold mt-1 truncate">Home</span>
            </a>
            <a href="/our-doctors.php" class="flex flex-col items-center justify-center rounded-md py-1.5 transition-colors duration-150 text-gray-500 hover:text-beige-700">
                <span class="leading-none">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.35-5.15a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </span>
                <span class="text-[10px] font-bold mt-1 truncate">Search</span>
            </a>
            <a href="<?php echo htmlspecialchars($LARAVEL_BOOKING_URL); ?>" class="flex flex-col items-center justify-center rounded-md py-1.5 transition-colors duration-150 text-gray-500 hover:text-beige-700">
                <span class="leading-none">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </span>
                <span class="text-[10px] font-bold mt-1 truncate">Book</span>
            </a>
            <a href="/services.php" class="flex flex-col items-center justify-center rounded-md py-1.5 transition-colors duration-150 text-gray-500 hover:text-beige-700">
                <span class="leading-none">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </span>
                <span class="text-[10px] font-bold mt-1 truncate">Services</span>
            </a>
        </div>
    </div>
    
    <script>
        window.addEventListener('scroll', () => {
            const header = document.getElementById('main-header');
            if (window.scrollY > 30) {
                header.classList.add('bg-white/95', 'backdrop-blur-md', 'border-gray-200', 'py-3');
                header.classList.remove('bg-white/90', 'backdrop-blur-sm', 'border-gray-100', 'py-4');
            } else {
                header.classList.add('bg-white/90', 'backdrop-blur-sm', 'border-gray-100', 'py-4');
                header.classList.remove('bg-white/95', 'backdrop-blur-md', 'border-gray-200', 'py-3');
            }
        });
    </script>
    
    <!-- Main content padding -->
    <main class="pt-[80px]">
