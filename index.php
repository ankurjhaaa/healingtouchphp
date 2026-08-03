<?php
require_once __DIR__ . '/config/db.php';

$seo_title = 'Healing Touch Hospital | Best Hospital in Purnea';
$seo_description = 'Experience world-class medical care with our team of dedicated specialists and patient-centered approach. Your health is our priority.';
$active_page = 'home';

// Fetch Doctors
$doctors = [];
try {
    $stmt = $pdo->prepare("
        SELECT u.id, u.name, d.image, d.qualification, d.available_days, d.slug, dep.name as department_name 
        FROM users u 
        INNER JOIN doctors d ON u.id = d.user_id 
        LEFT JOIN departments dep ON d.department_id = dep.id 
        WHERE (d.status = 1 OR d.status = '1')
        LIMIT 6
    ");
    $stmt->execute();
    $doctors = $stmt->fetchAll();
} catch (Exception $e) {
    // silently ignore or log
}

include __DIR__ . '/includes/header.php';
?>

<div class="bg-slate-50 min-h-screen">

    <!-- Hero Section (Full width, dark overlay, overlapping cards) -->
    <section class="relative bg-slate-900 text-white pb-24 pt-8 lg:pt-24 lg:pb-40 overflow-hidden">
        <!-- Background Image with sliding logic via script -->
        <div class="absolute inset-0 z-0">
            <img id="hero-slide-img" src="/assets/images/hospital-in-purnea-hero.jpg" class="w-full h-full object-cover opacity-40 mix-blend-overlay transition-opacity duration-500" alt="Healing Touch Hospital">
            <div class="absolute inset-0 bg-teal-950/80"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 container mx-auto px-4 max-w-5xl flex flex-col items-center text-center">
            
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-md bg-teal-800/80 text-teal-100 w-fit mb-4 md:mb-5 border border-teal-700 shadow-sm backdrop-blur-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="text-[10px] font-bold uppercase tracking-wider">Accepting New Patients</span>
            </div>

            <!-- Text -->
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold font-heading mb-3 md:mb-4 leading-tight tracking-tight">Healing Touch Hospital</h1>
            <p class="text-teal-50 text-sm md:text-base lg:text-lg max-w-2xl mb-6 md:mb-8 leading-relaxed font-medium">
                Experience world-class medical care with our team of dedicated specialists and a patient-centered approach in Purnea.
            </p>

            <!-- Search Box (Hidden on Mobile) -->
            <div class="hidden md:flex bg-white rounded-md p-1.5 md:p-2 flex-col md:flex-row w-full max-w-3xl gap-2 shadow-lg mb-6">
                <div class="flex items-center flex-1 border-b md:border-b-0 md:border-r border-slate-200 px-3 py-2">
                    <svg class="w-5 h-5 text-slate-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    <input type="text" value="Purnea, Bihar" readonly class="w-full bg-transparent border-none focus:ring-0 text-slate-700 text-sm md:text-base outline-none" />
                </div>
                <div class="flex items-center flex-[2] px-3 py-2">
                    <svg class="w-5 h-5 text-slate-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    <input type="text" placeholder="Search for doctors, specialists, services..." class="w-full bg-transparent border-none focus:ring-0 text-slate-700 text-sm md:text-base outline-none" />
                </div>
                <button class="bg-teal-700 hover:bg-teal-800 text-white px-8 py-3 rounded-md font-bold text-sm transition-colors w-full md:w-auto shrink-0">
                    Search
                </button>
            </div>

            <!-- Badges -->
            <div class="flex flex-wrap justify-center items-center gap-3 md:gap-6 text-xs text-slate-300 font-medium">
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Verified Doctors
                </div>
                <div class="hidden sm:block w-1 h-1 rounded-full bg-slate-500"></div>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    24/7 Support
                </div>
                <div class="hidden sm:block w-1 h-1 rounded-full bg-slate-500"></div>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    5k+ Patients
                </div>
            </div>
        </div>
    </section>

    <!-- Overlapping Quick Links (Doctors, Services, Locate, Emergency) -->
    <div class="container mx-auto px-4 max-w-6xl relative z-20 -mt-16 md:-mt-20 mb-12">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="/our-doctors.php" class="bg-white rounded-md p-5 md:p-6 border border-slate-200 hover:border-slate-300 hover:-translate-y-1 transition-all flex flex-col group">
                <div class="w-12 h-12 rounded-md bg-teal-50 flex items-center justify-center mb-4 group-hover:bg-teal-600 transition-colors">
                    <svg class="w-6 h-6 text-teal-700 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
                <h3 class="font-bold text-slate-900 text-sm md:text-base mb-1">Doctors</h3>
                <p class="text-slate-500 text-xs">View top specialists</p>
            </a>
            <a href="/services.php" class="bg-white rounded-md p-5 md:p-6 border border-slate-200 hover:border-slate-300 hover:-translate-y-1 transition-all flex flex-col group">
                <div class="w-12 h-12 rounded-md bg-sky-50 flex items-center justify-center mb-4 group-hover:bg-sky-600 transition-colors">
                    <svg class="w-6 h-6 text-sky-700 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                </div>
                <h3 class="font-bold text-slate-900 text-sm md:text-base mb-1">Services</h3>
                <p class="text-slate-500 text-xs">Comprehensive care</p>
            </a>
            <a href="/contact-us.php" class="bg-white rounded-md p-5 md:p-6 border border-slate-200 hover:border-slate-300 hover:-translate-y-1 transition-all flex flex-col group">
                <div class="w-12 h-12 rounded-md bg-amber-50 flex items-center justify-center mb-4 group-hover:bg-amber-600 transition-colors">
                    <svg class="w-6 h-6 text-amber-700 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                </div>
                <h3 class="font-bold text-slate-900 text-sm md:text-base mb-1">Locate</h3>
                <p class="text-slate-500 text-xs">Find us easily</p>
            </a>
            <a href="tel:+917903893945" class="bg-white rounded-md p-5 md:p-6 border border-slate-200 hover:border-slate-300 hover:-translate-y-1 transition-all flex flex-col group">
                <div class="w-12 h-12 rounded-md bg-rose-50 flex items-center justify-center mb-4 group-hover:bg-rose-600 transition-colors">
                    <svg class="w-6 h-6 text-rose-700 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <h3 class="font-bold text-slate-900 text-sm md:text-base mb-1">Emergency</h3>
                <p class="text-slate-500 text-xs">24/7 support available</p>
            </a>
        </div>
    </div>

    <!-- Doctors Section -->
    <div class="container mx-auto px-4 max-w-6xl mb-16">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl md:text-2xl font-extrabold text-slate-900 font-heading">Our Doctors</h2>
            <a href="/our-doctors.php" class="text-sm font-bold text-teal-700 hover:text-teal-800 transition-colors">See All Doctors</a>
        </div>

        <!-- Slider -->
        <div class="relative group">
            <!-- Chevron Left -->
            <button class="absolute left-0 top-1/2 -translate-y-1/2 -ml-4 w-10 h-10 bg-white rounded-full shadow-md border border-slate-100 flex items-center justify-center z-10 text-slate-600 hidden md:flex hover:bg-slate-50 transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            </button>

            <style>
                .hide-scrollbar::-webkit-scrollbar { display: none; }
            </style>
            <!-- Cards Container -->
            <div class="flex overflow-x-auto gap-4 md:gap-5 snap-x snap-mandatory hide-scrollbar pb-4" style="scrollbar-width: none; -ms-overflow-style: none;">
                <?php if(count($doctors) > 0): ?>
                    <?php foreach($doctors as $doctor): ?>
                    <div class="snap-start shrink-0 w-[280px] md:w-[310px] bg-white rounded-md border border-slate-200 p-5 flex flex-col hover:border-teal-300 hover:shadow-md transition-all">
                        <!-- Top: Avatar + Info -->
                        <div class="flex items-center gap-4 mb-5 border-b border-dashed border-slate-200 pb-5">
                            <div class="w-16 h-16 rounded-full bg-slate-100 overflow-hidden relative shrink-0">
                                <img src="<?php echo htmlspecialchars($doctor['image'] ?? '/assets/images/default.jpg'); ?>" class="w-full h-full object-cover">
                                <!-- Green Dot -->
                                <div class="absolute bottom-1 right-0 w-3.5 h-3.5 bg-emerald-500 border-2 border-white rounded-full"></div>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="font-bold text-slate-900 text-sm truncate">Dr. <?php echo htmlspecialchars($doctor['name']); ?></h3>
                                <p class="text-teal-700 text-xs font-semibold mb-1.5 truncate"><?php echo htmlspecialchars($doctor['department_name'] ?? 'General'); ?></p>
                                <div class="flex items-center text-xs text-slate-500">
                                    <svg class="w-3.5 h-3.5 text-amber-400 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    <span class="font-bold text-slate-700 mr-1">4.9</span> (120 reviews)
                                </div>
                            </div>
                        </div>

                        <!-- Middle: Exp & Fee -->
                        <div class="flex justify-between items-center mb-5 text-xs">
                            <div class="flex flex-col gap-2.5">
                                <span class="text-slate-500">Experience</span>
                                <span class="text-slate-500">Consultation Fee</span>
                            </div>
                            <div class="flex flex-col gap-2.5 text-right">
                                <span class="font-bold text-slate-800">12 Years</span>
                                <span class="font-bold text-slate-800">₹500.00</span>
                            </div>
                        </div>

                        <!-- Available Today -->
                        <div class="bg-emerald-50 text-emerald-700 rounded-md px-3 py-2 text-xs font-semibold flex items-center mb-4">
                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Available Today
                        </div>

                        <!-- Button -->
                        <a href="<?php echo htmlspecialchars($LARAVEL_BOOKING_URL ?? '#'); ?>/?slug=<?php echo urlencode($doctor['slug']); ?>" class="w-full border border-teal-700 text-teal-700 hover:bg-teal-700 hover:text-white rounded-md py-2.5 text-center font-bold text-sm transition-colors mt-auto block">
                            Book Appointment
                        </a>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="w-full text-center py-8">
                        <p class="text-sm text-slate-500 font-medium">No doctors available.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Chevron Right -->
            <button class="absolute right-0 top-1/2 -translate-y-1/2 -mr-4 w-10 h-10 bg-white rounded-full shadow-md border border-slate-100 flex items-center justify-center z-10 text-slate-600 hidden md:flex hover:bg-slate-50 transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
        </div>
    </div>

</div>

<!-- Simple Script for Hero Slider -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = [
            '/assets/images/hospital-in-purnea-hero.jpg',
            '/assets/images/hospital-in-purnea-facility.jpg',
            '/assets/images/hospital-in-purnea-critical-care.jpg'
        ];
        
        let activeSlide = 0;
        const img = document.getElementById('hero-slide-img');
        
        if(img && slides.length > 0) {
            setInterval(() => {
                activeSlide = (activeSlide + 1) % slides.length;
                img.style.opacity = 0;
                
                setTimeout(() => {
                    img.src = slides[activeSlide];
                    img.style.opacity = 1;
                }, 500);
            }, 4000);
        }
    });
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
