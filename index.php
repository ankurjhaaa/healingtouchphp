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
        LIMIT 4
    ");
    $stmt->execute();
    $doctors = $stmt->fetchAll();
} catch (Exception $e) {
    // silently ignore or log
}

include __DIR__ . '/includes/header.php';
?>

<div class="public-page min-h-screen bg-[#f5f7fb] md:bg-[#f8f9ff] font-sans text-gray-900 antialiased overflow-x-hidden pb-16 lg:pb-0 flex flex-col">

    <!-- Hero Section -->
    <section class="relative pt-20 pb-4 sm:pb-12 md:pt-28 md:pb-16 bg-[#f5f7fb] md:bg-beige-50 overflow-hidden md:border-b md:border-gray-200">
        <div class="container mx-auto px-3 sm:px-4 flex flex-col md:flex-row items-stretch md:items-center relative z-10 w-full max-w-7xl gap-3 md:gap-0">
            <div class="md:w-1/2 mb-0 md:mb-0 px-0 md:px-4 order-2 md:order-1">
                <div class="bg-transparent border-0 rounded-none p-0 md:bg-transparent md:border-0 md:rounded-none md:p-0">
                    <div class="inline-flex md:hidden items-center gap-2 rounded-full border border-beige-100 bg-white px-3 py-1.5 text-[11px] font-black uppercase tracking-[0.12em] text-beige-700">
                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                        Open for appointments
                    </div>
                    <h1 class="mt-2 md:mt-0 text-[1.65rem] sm:text-4xl md:text-5xl font-bold text-neutral-800 leading-tight mb-2 md:mb-3">
                        Best Hospital in Purnea <span class="text-beige-700 block mt-1">Compassionate Care in Purnia</span>
                    </h1>
                    <p class="text-[13px] sm:text-lg text-gray-600 mb-3 sm:mb-6 leading-relaxed max-w-xl">
                        Experience world-class medical care with our team of dedicated specialists and
                        patient-centered approach. Your health is our priority.
                    </p>
                    <div class="hidden md:flex flex-col sm:flex-row gap-2.5">
                        <a href="<?php echo htmlspecialchars($LARAVEL_BOOKING_URL); ?>" class="bg-beige-600 hover:bg-beige-700 text-white px-5 py-3 rounded-md transition-colors duration-150 border border-beige-600 text-sm sm:text-base font-semibold flex items-center justify-center">
                            <span>Book Appointment</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="/our-doctors.php" class="bg-white text-beige-700 px-5 py-3 rounded-md border border-beige-200 text-sm sm:text-base font-semibold flex items-center justify-center hover:bg-beige-50">
                            Browse Doctors
                        </a>
                    </div>
                    <div class="md:hidden mt-3">
                        <a href="<?php echo htmlspecialchars($LARAVEL_BOOKING_URL); ?>" class="rounded-md border border-beige-600 bg-beige-600 px-4 py-3 text-sm font-black text-white shadow-sm flex items-center justify-center gap-2">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M5 11h14M6.75 21h10.5A2.25 2.25 0 0019.5 18.75V6.75A2.25 2.25 0 0017.25 4.5H6.75A2.25 2.25 0 004.5 6.75v12A2.25 2.25 0 006.75 21z" />
                            </svg>
                            Book Appointment
                        </a>
                    </div>
                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 gap-2 mt-3 sm:mt-6 max-w-sm">
                        <div class="flex items-center bg-white md:bg-beige-50 rounded-md border border-gray-200 md:border-beige-100 p-2.5 shadow-sm md:shadow-none">
                            <div class="bg-beige-100 p-2 rounded-md mr-2.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6 text-beige-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-lg text-gray-800 leading-none">10+</p>
                                <p class="text-[11px] text-gray-600">Years Experience</p>
                            </div>
                        </div>
                        <div class="flex items-center bg-white md:bg-beige-50 rounded-md border border-gray-200 md:border-beige-100 p-2.5 shadow-sm md:shadow-none">
                            <div class="bg-beige-100 p-2 rounded-md mr-2.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6 text-beige-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-lg text-gray-800 leading-none">5000+</p>
                                <p class="text-[11px] text-gray-600">Treatments</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="md:w-1/2 relative px-0 md:px-4 pt-0 md:pt-0 order-1 md:order-2">
                <div class="relative h-[235px] sm:h-[320px] md:h-[380px] lg:h-[430px] overflow-hidden rounded-md border border-gray-200 shadow-sm md:shadow-none bg-gray-200">
                    <img
                        id="hero-slide-img"
                        src="/assets/images/hospital-in-purnea-hero.jpg"
                        alt="Best Hospital in Purnea (Purnia)"
                        class="absolute inset-0 h-full w-full object-cover transition-opacity duration-700 opacity-100"
                    />
                    <div class="absolute inset-x-0 bottom-0 flex items-end justify-between bg-black/40 p-3 md:p-4">
                        <div class="text-white">
                            <p class="text-xs font-black uppercase tracking-[0.16em] opacity-80">Healing Touch</p>
                            <p id="hero-slide-label" class="text-base md:text-lg font-black">Family Care</p>
                        </div>
                        <div class="flex gap-1.5" id="hero-slide-indicators">
                            <button class="h-1.5 rounded-full transition-all w-5 bg-white"></button>
                            <button class="h-1.5 rounded-full transition-all w-1.5 bg-white/60"></button>
                            <button class="h-1.5 rounded-full transition-all w-1.5 bg-white/60"></button>
                        </div>
                    </div>
                </div>
                <div class="absolute bottom-3 left-3 md:-bottom-4 md:-left-4 bg-white p-2.5 rounded-md border border-gray-200 flex items-center space-x-2 shadow-sm md:shadow-none">
                    <div class="bg-beige-100 p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-beige-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-800 text-sm">Safe & Quality Care</p>
                        <p class="text-xs text-gray-500">Advanced protocols</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Doctors Section -->
    <section class="py-6 md:py-12 bg-gray-50">
        <div class="container mx-auto px-3 sm:px-4 max-w-7xl">
            <div class="mb-4 md:mb-10 md:text-center flex md:block items-end justify-between gap-3">
                <div>
                    <span class="text-beige-600 font-semibold text-[11px] md:text-sm uppercase tracking-wider">Our Trusted Specialists</span>
                    <h2 class="text-xl md:text-4xl font-bold text-gray-800 mt-1 md:mt-2 md:mb-4">Specialists at our <span class="text-beige-600">Hospital in Purnea</span></h2>
                </div>
                <a href="/our-doctors.php" class="md:hidden shrink-0 text-xs font-black text-beige-700">View all</a>
                <div class="hidden md:block w-24 h-1 bg-beige-600 mx-auto"></div>
            </div>

            <div class="flex md:grid md:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6 overflow-x-auto md:overflow-visible no-scrollbar snap-x">
                <?php if(count($doctors) > 0): ?>
                    <?php foreach($doctors as $doctor): ?>
                    <div class="bg-white rounded-md md:rounded-md overflow-hidden h-full flex flex-col border border-gray-200 min-w-[82%] sm:min-w-[48%] md:min-w-0 snap-start shadow-sm md:shadow-none">
                        <div class="p-3 md:p-4 flex-grow">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0">
                                    <img class="w-16 h-16 md:w-20 md:h-20 rounded-md object-cover border border-beige-200" src="<?php echo htmlspecialchars($doctor['image'] ?? '/assets/images/default.jpg'); ?>" alt="Dr. <?php echo htmlspecialchars($doctor['name']); ?>" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-base md:text-lg font-bold text-gray-800 truncate">Dr. <?php echo htmlspecialchars($doctor['name']); ?></h3>
                                    <p class="text-xs md:text-sm font-medium text-beige-600 truncate"><?php echo htmlspecialchars($doctor['department_name'] ?? '-'); ?></p>
                                    <p class="text-xs md:text-sm font-medium text-gray-600 line-clamp-1">
                                        <?php echo htmlspecialchars(is_string($doctor['qualification']) ? str_replace('"', '', trim($doctor['qualification'], '[]')) : '-'); ?>
                                    </p>
                                    <p class="font-medium text-xs line-clamp-1 text-gray-500 mt-1">
                                        <?php echo htmlspecialchars(is_string($doctor['available_days']) ? str_replace('"', '', trim($doctor['available_days'], '[]')) : '-'); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="mt-3 md:mt-5 flex items-center text-amber-500">
                                <?php for($i=0; $i<5; $i++): ?>
                                <svg class="w-4 h-4" fill="#906A39" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-3 md:px-4 py-3 border-t border-gray-200 mt-auto flex gap-2">
                            <a href="/doctor-details.php?slug=<?php echo urlencode($doctor['slug']); ?>" class="flex-1 text-center py-2 rounded-md border border-gray-300 text-gray-700 text-sm font-semibold hover:bg-white">View Details</a>
                            <a href="<?php echo htmlspecialchars($LARAVEL_BOOKING_URL); ?>/?slug=<?php echo urlencode($doctor['slug']); ?>" class="flex-1 text-center py-2 rounded-md bg-beige-600 text-white text-sm font-semibold hover:bg-beige-700 border border-beige-600">Book Now</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-full text-center text-gray-500 py-10">No doctors available at the moment.</div>
                <?php endif; ?>
            </div>
            
            <div class="hidden md:block mt-12 text-center">
                <a href="/our-doctors.php" class="text-beige-600 font-bold hover:text-beige-800 flex items-center justify-center gap-2">
                    View All Doctors <span>→</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Facilities Section -->
    <section class="py-6 md:py-10 bg-white">
        <div class="container mx-auto px-3 sm:px-4 max-w-7xl">
            <div class="mb-4 md:mb-12 md:text-center">
                <span class="text-beige-600 font-semibold text-[11px] md:text-sm uppercase tracking-wider">World-Class Medical Care</span>
                <h2 class="text-xl md:text-4xl font-bold text-beige-900 mt-1 md:mt-2 md:mb-4">Facilities at our <span class="text-beige-600">Hospital in Purnea</span></h2>
                <div class="hidden md:block w-24 h-1 bg-beige-400 mx-auto mb-6"></div>
                <p class="max-w-2xl md:mx-auto text-xs md:text-base text-gray-600">Experience healthcare excellence with our state-of-the-art facilities and compassionate medical professionals.</p>
            </div>
            
            <div class="flex md:grid md:grid-cols-3 gap-3 md:gap-5 overflow-x-auto md:overflow-visible no-scrollbar snap-x pb-1">
                <div class="bg-gray-50 md:bg-white p-4 md:p-6 rounded-md md:rounded-md border border-gray-200 group min-w-[82%] sm:min-w-[58%] md:min-w-0 snap-start">
                    <div class="bg-beige-100 p-2.5 md:p-3 rounded-md inline-block mb-3 md:mb-4 group-hover:bg-beige-200 transition-colors duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 md:h-10 md:w-10 text-beige-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    </div>
                    <h3 class="text-base md:text-xl font-bold text-gray-800 mb-2 md:mb-3">Expert Doctors</h3>
                    <p class="text-sm md:text-base text-gray-600 leading-relaxed line-clamp-3 md:line-clamp-none">Board-certified specialists with years of experience dedicated to providing compassionate patient care.</p>
                    <div class="mt-4 flex items-center text-beige-600 font-medium">
                        <a href="/our-doctors.php"><span>Learn more</span></a>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                    </div>
                </div>

                <div class="bg-gray-50 md:bg-white p-4 md:p-6 rounded-md md:rounded-md border border-gray-200 group min-w-[82%] sm:min-w-[58%] md:min-w-0 snap-start">
                    <div class="bg-beige-100 p-2.5 md:p-3 rounded-md inline-block mb-3 md:mb-4 group-hover:bg-beige-200 transition-colors duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 md:h-10 md:w-10 text-beige-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </div>
                    <h3 class="text-base md:text-xl font-bold text-gray-800 mb-2 md:mb-3">Advanced Facilities</h3>
                    <p class="text-sm md:text-base text-gray-600 leading-relaxed line-clamp-3 md:line-clamp-none">State-of-the-art medical equipment and modern healing environments designed for optimal patient recovery.</p>
                    <div class="mt-4 flex items-center text-beige-600 font-medium">
                        <a href="/services.php"><span>Learn more</span></a>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                    </div>
                </div>

                <div class="bg-gray-50 md:bg-white p-4 md:p-6 rounded-md md:rounded-md border border-gray-200 group min-w-[82%] sm:min-w-[58%] md:min-w-0 snap-start">
                    <div class="bg-beige-100 p-2.5 md:p-3 rounded-md inline-block mb-3 md:mb-4 group-hover:bg-beige-200 transition-colors duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 md:h-10 md:w-10 text-beige-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                    </div>
                    <h3 class="text-base md:text-xl font-bold text-gray-800 mb-2 md:mb-3">Patient-Centered Care</h3>
                    <p class="text-sm md:text-base text-gray-600 leading-relaxed line-clamp-3 md:line-clamp-none">Personalized treatment plans focused on your health and comfort, putting your needs at the center of everything we do.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-6 md:py-12 bg-beige-50 border-y border-gray-200">
        <div class="container mx-auto px-3 sm:px-4 max-w-7xl">
            <div class="mb-4 md:mb-10 text-center">
                <span class="text-beige-600 font-semibold text-[11px] md:text-sm uppercase tracking-wider">Our Story</span>
                <h2 class="text-xl md:text-4xl font-bold text-beige-900 mt-1 md:mt-2">About Our <span class="text-beige-600">Hospital in Purnea</span></h2>
                <div class="hidden md:block w-24 h-1 bg-beige-400 mx-auto mt-4"></div>
            </div>
            
            <div class="rounded-md md:rounded-md border border-beige-100 bg-white p-3 md:p-8 shadow-sm">
                <div class="grid grid-cols-1 md:grid-cols-[1.02fr_0.98fr] gap-4 md:gap-8 items-start">
                    <div class="space-y-3 md:space-y-4">
                        <div class="relative overflow-hidden rounded-md md:rounded-md border border-gray-200">
                            <img src="/assets/images/hospital-in-purnea-building.jpg" alt="Healing Touch" class="w-full h-[180px] sm:h-[220px] md:h-[310px] object-cover" />
                            <div class="absolute inset-x-0 bottom-0 bg-black/40 p-3 md:p-4">
                                <p class="text-[11px] md:text-xs font-black uppercase tracking-[0.14em] text-white/80">Since 1995</p>
                                <p class="text-sm md:text-base font-black text-white">Serving families with trusted care</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="rounded-md border border-gray-200 bg-gray-50 px-3 py-2.5">
                                <p class="text-[10px] font-black uppercase tracking-[0.14em] text-gray-500">Experience</p>
                                <p class="text-sm md:text-base font-black text-gray-800 mt-0.5">25+ Years</p>
                            </div>
                            <div class="rounded-md border border-gray-200 bg-gray-50 px-3 py-2.5">
                                <p class="text-[10px] font-black uppercase tracking-[0.14em] text-gray-500">Approach</p>
                                <p class="text-sm md:text-base font-black text-gray-800 mt-0.5">Patient First</p>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-md md:rounded-md border border-gray-200 bg-gray-50 p-4 md:p-6">
                        <h3 class="text-base md:text-2xl font-bold text-gray-800">Our Mission</h3>
                        <p class="text-sm md:text-base text-gray-700 mt-2 leading-relaxed">
                            At Healing Touch Hospital, our mission is to provide accessible, compassionate, and high-quality healthcare for every family in the community.
                        </p>
                        <h3 class="text-base md:text-2xl font-bold text-gray-800 mt-5 md:mt-7">Our Values</h3>
                        <ul class="mt-3 grid grid-cols-1 gap-2.5 text-beige-700">
                            <?php foreach(['Excellence', 'Compassion', 'Innovation', 'Integrity'] as $value): ?>
                            <li class="flex items-start bg-white p-3 rounded-md border border-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5 text-beige-600 mr-2.5 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                <span class="text-xs md:text-sm text-gray-700"><span class="font-bold text-gray-800"><?php echo $value; ?></span> — Delivering trusted, patient-first healthcare.</span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Hero slider script -->
<script>
    const slides = [
        { src: '/assets/images/hospital-in-purnea-hero.jpg', label: 'Family Care' },
        { src: '/assets/images/hospital-in-purnea-facility.jpg', label: 'Modern Facility' },
        { src: '/assets/images/hospital-in-purnea-critical-care.jpg', label: 'Critical Care' }
    ];
    let activeSlide = 0;
    
    function changeSlide(index) {
        activeSlide = index;
        const img = document.getElementById('hero-slide-img');
        const label = document.getElementById('hero-slide-label');
        const indicators = document.getElementById('hero-slide-indicators').children;
        
        img.style.opacity = 0;
        setTimeout(() => {
            img.src = slides[activeSlide].src;
            img.style.opacity = 1;
            label.innerText = slides[activeSlide].label;
        }, 300);
        
        for(let i = 0; i < indicators.length; i++) {
            if(i === activeSlide) {
                indicators[i].className = "h-1.5 rounded-full transition-all w-5 bg-white";
            } else {
                indicators[i].className = "h-1.5 rounded-full transition-all w-1.5 bg-white/60";
            }
        }
    }

    setInterval(() => {
        let nextSlide = (activeSlide + 1) % slides.length;
        changeSlide(nextSlide);
    }, 3500);
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
