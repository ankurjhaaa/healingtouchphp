<?php
$seo_title = $seo_title ?? 'Healing Touch Hospital';
$seo_description = $seo_description ?? 'Compassionate and accessible healthcare with trusted specialists and modern facilities.';
$seo_keywords = $seo_keywords ?? 'Hospital, Healthcare, Doctors, Purnea';
$active_page = $active_page ?? 'home';

function is_active($page, $active_page) {
    return $page === $active_page 
        ? 'text-teal-700 border-b-2 border-teal-700 font-bold' 
        : 'text-slate-600 hover:text-teal-700 border-b-2 border-transparent hover:border-teal-700 font-medium';
}

function is_mobile_active($page, $active_page) {
    return $page === $active_page 
        ? 'text-teal-700 font-bold' 
        : 'text-slate-400 hover:text-teal-700 font-medium';
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <title><?php echo isset($seo_title) ? htmlspecialchars($seo_title) : 'Healing Touch Hospital'; ?></title>
    <meta name="description" content="<?php echo isset($seo_description) ? htmlspecialchars($seo_description) : 'Healing Touch Hospital offers top-quality medical care in Purnea.'; ?>">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (compiled or CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        teal: {
                            50: '#f0fdfa',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            background-color: #f8fafc; /* bg-slate-50 */
            color: #0f172a;
            -webkit-font-smoothing: antialiased;
            /* Extra padding at bottom for mobile nav bar */
            padding-bottom: env(safe-area-inset-bottom); 
        }

        @media (max-width: 1024px) {
            body {
                padding-bottom: calc(72px + env(safe-area-inset-bottom));
            }
        }
        
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">
    
    <!-- Top App Bar -->
    <header id="main-header" class="fixed w-full top-0 z-50 bg-white shadow-sm border-b border-gray-100">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="flex justify-between items-center h-[70px] lg:h-[80px]">
                
                <!-- Logo Area -->
                <a href="/index.php" class="flex items-center gap-3">
                    <img src="/assets/images/healingTouchLogo.jpeg" alt="Healing Touch Logo" class="h-10 w-10 sm:h-12 sm:w-12 object-cover rounded-md border border-slate-100">
                    <div class="flex flex-col justify-center">
                        <div class="font-heading font-extrabold text-lg sm:text-2xl text-slate-900 tracking-tight leading-none">
                            <span class="text-teal-700">Healing</span>Touch
                        </div>
                        <p class="text-[9px] sm:text-[11px] text-slate-500 font-bold uppercase tracking-widest mt-1">Purnea</p>
                    </div>
                </a>

                <!-- Desktop Navigation (Hidden on Mobile) -->
                <nav class="hidden lg:flex items-center gap-2">
                    <a href="/index.php" class="px-4 py-2 text-sm transition-all duration-200 <?php echo is_active('home', $active_page); ?>">Home</a>
                    <a href="/services.php" class="px-4 py-2 text-sm transition-all duration-200 <?php echo is_active('services', $active_page); ?>">Services</a>
                    <a href="/our-doctors.php" class="px-4 py-2 text-sm transition-all duration-200 <?php echo is_active('doctors', $active_page); ?>">Doctors</a>
                    <a href="/about-us.php" class="px-4 py-2 text-sm transition-all duration-200 <?php echo is_active('about', $active_page); ?>">About</a>
                    <a href="/gallery.php" class="px-4 py-2 text-sm transition-all duration-200 <?php echo is_active('gallery', $active_page); ?>">Gallery</a>
                    <a href="/careers.php" class="px-4 py-2 text-sm transition-all duration-200 <?php echo is_active('careers', $active_page); ?>">Careers</a>
                    <a href="/contact-us.php" class="px-4 py-2 text-sm transition-all duration-200 <?php echo is_active('contact', $active_page); ?>">Contact</a>
                </nav>

                <!-- Call to Action -->
                <div class="flex items-center gap-4">
                    <a href="tel:+917903893945" class="lg:hidden flex items-center justify-center w-10 h-10 bg-teal-50 text-teal-700 rounded-md border border-teal-100">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                    </a>
                    
                    <div class="hidden xl:flex flex-col items-end mr-2">
                        <span class="text-[10px] text-slate-500 font-bold uppercase tracking-wider">Emergency 24/7</span>
                        <a href="tel:+917903893945" class="text-base font-heading font-extrabold text-slate-900 hover:text-teal-700 transition-colors">+91 79038 93945</a>
                    </div>
                    <a href="<?php echo htmlspecialchars($LARAVEL_BOOKING_URL ?? '#'); ?>" class="hidden sm:flex bg-teal-700 hover:bg-teal-800 text-white px-6 py-2.5 rounded-md font-heading font-bold text-[14px] tracking-wide uppercase transition-colors items-center gap-2 shadow-sm">
                        Book Now
                    </a>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Mobile Bottom Navigation Bar -->
    <nav class="lg:hidden fixed bottom-0 w-full bg-white/95 backdrop-blur-md border-t border-slate-200 z-50 pb-[env(safe-area-inset-bottom)] shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
        <div class="flex justify-between items-center px-4 sm:px-6 h-[72px]">
            <!-- Home -->
            <a href="/index.php" class="flex flex-col items-center justify-center gap-1 w-[20%] h-full <?php echo is_mobile_active('home', $active_page); ?>">
                <svg class="w-6 h-6 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-[11px] font-bold">Home</span>
            </a>
            
            <!-- Services -->
            <a href="/services.php" class="flex flex-col items-center justify-center gap-1 w-[20%] h-full <?php echo is_mobile_active('services', $active_page); ?>">
                <svg class="w-6 h-6 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <span class="text-[11px] font-bold">Services</span>
            </a>
            
            <!-- Doctors -->
            <a href="/our-doctors.php" class="flex flex-col items-center justify-center gap-1 w-[20%] h-full <?php echo is_mobile_active('doctors', $active_page); ?>">
                <svg class="w-6 h-6 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span class="text-[11px] font-bold">Doctors</span>
            </a>

            <!-- Menu (Replaces Sidebar) -->
            <button onclick="document.getElementById('mobile-menu-modal').classList.remove('translate-x-full'); document.getElementById('mobile-menu-modal').classList.remove('hidden'); setTimeout(() => { document.getElementById('mobile-menu-modal-overlay').classList.remove('opacity-0'); document.getElementById('mobile-menu-modal-content').classList.remove('translate-x-full'); }, 10);" class="flex flex-col items-center justify-center gap-1 w-[20%] h-full text-slate-500 hover:text-teal-700 transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <span class="text-[11px] font-bold">Menu</span>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu Full Modal -->
    <div id="mobile-menu-modal" class="hidden fixed inset-0 z-[100] flex justify-end">
        <!-- Backdrop -->
        <div id="mobile-menu-modal-overlay" class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm opacity-0 transition-opacity duration-300" onclick="closeMobileMenu()"></div>
        
        <!-- Sidebar Content -->
        <div id="mobile-menu-modal-content" class="relative w-[85%] max-w-sm bg-slate-50 h-full flex flex-col shadow-2xl translate-x-full transition-transform duration-300 ease-out">
            <!-- Header (Matches Navbar) -->
            <div class="flex items-center justify-between px-4 h-[70px] border-b border-slate-200 bg-white shadow-sm shrink-0">
                <a href="/index.php" class="flex items-center gap-3">
                    <img src="/assets/images/healingTouchLogo.jpeg" alt="Healing Touch Logo" class="h-10 w-10 object-cover rounded-md border border-slate-100">
                    <div class="flex flex-col justify-center">
                        <div class="font-heading font-extrabold text-lg text-slate-900 tracking-tight leading-none">
                            <span class="text-teal-700">Healing</span>Touch
                        </div>
                        <p class="text-[9px] text-slate-500 font-bold uppercase tracking-widest mt-1">Purnea</p>
                    </div>
                </a>
                <button onclick="closeMobileMenu()" class="p-2 bg-slate-50 rounded-md text-slate-600 border border-slate-200 hover:bg-slate-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            
            <!-- Links Area -->
            <div class="p-4 flex flex-col gap-3 overflow-y-auto flex-grow bg-slate-50">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1 px-1">Menu</p>
                
                <a href="/about-us.php" class="p-4 bg-white rounded-md border border-slate-200 shadow-sm text-slate-800 font-bold flex items-center justify-between hover:border-teal-300 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-md bg-teal-50 flex items-center justify-center text-teal-700 border border-teal-100">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        About Us
                    </div>
                    <svg class="w-5 h-5 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                
                <a href="/gallery.php" class="p-4 bg-white rounded-md border border-slate-200 shadow-sm text-slate-800 font-bold flex items-center justify-between hover:border-teal-300 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-md bg-teal-50 flex items-center justify-center text-teal-700 border border-teal-100">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        Gallery
                    </div>
                    <svg class="w-5 h-5 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                
                <a href="/careers.php" class="p-4 bg-white rounded-md border border-slate-200 shadow-sm text-slate-800 font-bold flex items-center justify-between hover:border-teal-300 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-md bg-teal-50 flex items-center justify-center text-teal-700 border border-teal-100">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        </div>
                        Careers
                    </div>
                    <svg class="w-5 h-5 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                
                <a href="/contact-us.php" class="p-4 bg-white rounded-md border border-slate-200 shadow-sm text-slate-800 font-bold flex items-center justify-between hover:border-teal-300 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-md bg-teal-50 flex items-center justify-center text-teal-700 border border-teal-100">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                        </div>
                        Contact Us
                    </div>
                    <svg class="w-5 h-5 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
            
            <!-- Fixed Bottom Book Button -->
            <div class="p-4 bg-white border-t border-slate-200 shrink-0 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] pb-[calc(1rem+env(safe-area-inset-bottom))]">
                <a href="<?php echo htmlspecialchars($LARAVEL_BOOKING_URL ?? '#'); ?>" class="flex w-full items-center justify-center bg-teal-700 hover:bg-teal-800 text-white px-5 py-3.5 rounded-md font-heading font-bold text-sm tracking-wide uppercase shadow-sm transition-colors">
                    Book Appointment
                </a>
            </div>
        </div>
    </div>
    
    <script>
        function closeMobileMenu() {
            document.getElementById('mobile-menu-modal-overlay').classList.add('opacity-0');
            document.getElementById('mobile-menu-modal-content').classList.add('translate-x-full');
            setTimeout(() => {
                document.getElementById('mobile-menu-modal').classList.add('hidden');
            }, 300);
        }
    </script>
    
    <!-- Main content wrapper -->
    <main class="flex-grow pt-[70px] lg:pt-[80px]">
