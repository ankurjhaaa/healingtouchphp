<?php
require_once __DIR__ . '/config/db.php';

$seo_title = 'Our Services | Healing Touch Hospital';
$seo_description = 'Explore our multispeciality care unit, ICU, NICU, Ultrasound, Neurosurgery, and more at Healing Touch Hospital.';
$active_page = 'services';

include __DIR__ . '/includes/header.php';

$services = [
    [
        'id' => 'multispeciality',
        'name' => 'Multispeciality',
        'title' => 'Multispeciality Care',
        'image' => '/assets/images/hospital1.jpg',
        'description' => 'Our multispeciality care unit provides expert consultation and treatment across cardiology, orthopedics, gynecology, and more.',
        'icon' => '<svg class="w-6 h-6 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>'
    ],
    [
        'id' => 'icu',
        'name' => 'ICU',
        'title' => 'ICU Services',
        'image' => '/assets/images/hospital3.jpg',
        'description' => 'Our ICU provides advanced critical care and continuous monitoring for seriously ill patients and post-surgery recovery.',
        'icon' => '<svg class="w-6 h-6 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>'
    ],
    [
        'id' => 'nicu',
        'name' => 'NICU',
        'title' => 'NICU Services',
        'image' => '/assets/images/hospital4.jpg',
        'description' => 'Our NICU offers specialized support for premature and critically ill newborns with expert neonatal supervision.',
        'icon' => '<svg class="w-6 h-6 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>'
    ],
    [
        'id' => 'ultrasound',
        'name' => 'Ultrasound',
        'title' => 'Ultrasound Services',
        'image' => '/assets/images/hospital5.jpg',
        'description' => 'We provide accurate ultrasound diagnostics for timely monitoring and treatment planning.',
        'icon' => '<svg class="w-6 h-6 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" /></svg>'
    ],
    [
        'id' => 'neurosurgery',
        'name' => 'Neurosurgery',
        'title' => 'Neurosurgery',
        'image' => '/assets/images/hospital6.jpg',
        'description' => 'Our neurosurgery team handles complex brain and spine procedures with modern surgical care.',
        'icon' => '<svg class="w-6 h-6 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>'
    ],
    [
        'id' => 'x-ray',
        'name' => 'X-RAY',
        'title' => 'X-RAY Services',
        'image' => '/assets/images/hospital7.jpg',
        'description' => 'Fast and reliable X-ray imaging services for injury assessment and medical diagnosis.',
        'icon' => '<svg class="w-6 h-6 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>'
    ],
    [
        'id' => 'pathology',
        'name' => 'Pathology',
        'title' => 'Pathology Services',
        'image' => '/assets/images/hospital8.jpg',
        'description' => 'Comprehensive pathology testing with dependable reports for quick clinical decisions.',
        'icon' => '<svg class="w-6 h-6 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>'
    ],
    [
        'id' => 'painless-normal-delivery',
        'name' => 'Painless Delivery',
        'title' => 'Painless Normal Delivery',
        'image' => '/assets/images/hospital3.jpg',
        'description' => 'We offer painless normal delivery options for a safer, more comfortable childbirth experience.',
        'icon' => '<svg class="w-6 h-6 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>'
    ],
    [
        'id' => '24-hrs-delivery-service',
        'name' => '24 Hrs Delivery',
        'title' => '24 hrs Delivery Service',
        'image' => '/assets/images/hospital5.jpg',
        'description' => 'Round-the-clock delivery support ensures access to expert maternity care any time.',
        'icon' => '<svg class="w-6 h-6 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
    ],
];
?>

<!-- App Body Layout -->
<div class="bg-slate-50 min-h-screen pb-6">
    
    <!-- Top Spacing -->
    <div class="h-4 lg:h-6"></div>

    <div class="container mx-auto px-4 max-w-7xl flex flex-col gap-4 lg:gap-6">
        
        <!-- App Header Banner (Flat Design) -->
        <section class="bg-slate-900 rounded-md p-6 relative overflow-hidden shadow-sm flex flex-col justify-center min-h-[140px] border border-slate-800">
            <div class="relative z-10">
                <h1 class="font-heading text-2xl sm:text-3xl font-extrabold text-white mb-1 tracking-tight">Our <span class="text-teal-400">Services</span></h1>
                <p class="text-slate-300 text-xs sm:text-sm max-w-md">Comprehensive medical care tailored for you and your family.</p>
            </div>
        </section>

        <!-- Services Grid (App Cards) -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php foreach ($services as $service): ?>
            <div class="bg-white rounded-md shadow-sm border border-slate-200 flex flex-col overflow-hidden">
                <div class="h-40 sm:h-48 relative bg-slate-100">
                    <img src="<?php echo $service['image']; ?>" alt="<?php echo $service['title']; ?>" class="w-full h-full object-cover" />
                </div>
                <div class="p-4 flex-grow relative border-t border-slate-100">
                    <div class="w-10 h-10 rounded-md bg-teal-50 border border-teal-100 flex items-center justify-center absolute -top-5 right-4 shadow-sm">
                        <?php echo $service['icon']; ?>
                    </div>
                    <h3 class="font-heading font-extrabold text-base text-slate-900 mb-1 pr-10 mt-1"><?php echo htmlspecialchars($service['title']); ?></h3>
                    <p class="text-slate-500 text-xs leading-relaxed mb-4"><?php echo htmlspecialchars($service['description']); ?></p>
                    
                    <a href="<?php echo htmlspecialchars($LARAVEL_BOOKING_URL); ?>" class="inline-flex items-center justify-center w-full bg-slate-50 hover:bg-teal-50 border border-slate-200 hover:border-teal-200 text-teal-700 font-bold text-xs py-2.5 rounded-md transition-colors">
                        Book Appointment 
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </section>

        <!-- Emergency Banner App Style (Flat Design) -->
        <section class="bg-red-50 rounded-md p-4 lg:p-6 shadow-sm border border-red-200 flex flex-col sm:flex-row items-center gap-4 justify-between mt-2">
            <div>
                <div class="inline-flex items-center gap-2 px-2 py-1 bg-red-100 text-red-700 rounded-md text-[10px] font-bold uppercase mb-2 border border-red-200">
                    <span class="w-1.5 h-1.5 rounded-md bg-red-600 animate-pulse"></span> Emergency 24/7
                </div>
                <h3 class="font-heading font-extrabold text-slate-900 text-base mb-1">Need Immediate Help?</h3>
                <p class="text-slate-600 text-xs">Our emergency department is open 24/7.</p>
            </div>
            
            <a href="tel:+917903893945" class="w-full sm:w-auto bg-red-600 active:bg-red-700 text-white px-5 py-3 rounded-md font-heading font-bold text-sm flex items-center justify-center gap-2 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                Call Now
            </a>
        </section>
        
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
