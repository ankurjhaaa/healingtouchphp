<?php
require_once __DIR__ . '/config/db.php';

$seo_title = 'About Us | Healing Touch Hospital, Purnea (Bihar)';
$seo_description = 'At Healing Touch Hospital, we are committed to providing compassionate, high-quality healthcare with a focus on patient well-being and comfort.';
$active_page = 'about';

include __DIR__ . '/includes/header.php';
?>

<!-- App Body Layout -->
<div class="bg-slate-50 min-h-screen pb-6 flex flex-col">
    <!-- Top Spacing -->
    <div class="h-4 lg:h-6"></div>

    <div class="container mx-auto px-4 max-w-7xl flex flex-col gap-4 lg:gap-6 flex-grow">
        
        <!-- App Header Banner -->
        <section class="bg-white rounded-md p-6 relative overflow-hidden shadow-sm flex flex-col justify-center min-h-[140px] shrink-0 border border-slate-200">
            <div class="relative z-10 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-2 py-1 bg-teal-50 text-teal-700 rounded-md text-[10px] font-bold uppercase mb-3 border border-teal-100">
                    Who We Are
                </div>
                <h1 class="font-heading text-2xl sm:text-3xl font-extrabold text-slate-900 mb-2 tracking-tight">About Healing Touch</h1>
                <p class="text-slate-500 text-xs sm:text-sm">We are committed to providing compassionate, high-quality healthcare with a focus on patient well-being and comfort.</p>
            </div>
        </section>

        <!-- Mission & Image Card -->
        <section class="bg-white rounded-md shadow-sm overflow-hidden flex flex-col lg:flex-row border border-slate-200">
            <!-- Image Area -->
            <div class="w-full lg:w-1/2 aspect-video lg:aspect-auto bg-slate-100 relative shrink-0">
                <img src="/assets/images/heroImageHt.jpg" alt="Healing Touch Hospital" class="w-full h-full object-cover" onerror="this.src='/assets/images/hospital-in-purnea-building.jpg'" />
            </div>
            
            <!-- Content Area -->
            <div class="p-6 flex flex-col justify-center border-t lg:border-t-0 lg:border-l border-slate-200">
                <div class="mb-6">
                    <h2 class="font-heading text-lg sm:text-xl font-extrabold text-slate-900 mb-2">Our Mission</h2>
                    <div class="bg-slate-50 rounded-md p-4 border-l-4 border-teal-600">
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                            To deliver exceptional medical care with a human touch. We aim to create a healing environment where every patient is treated with dignity, respect, and empathy.
                        </p>
                    </div>
                </div>

                <div>
                    <h2 class="font-heading text-lg sm:text-xl font-extrabold text-slate-900 mb-3">Core Services</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <?php 
                        $services = [
                            '24/7 Emergency Care',
                            'Advanced Diagnostics & Imaging',
                            'Specialized Surgical Services',
                            'Maternity & Childcare',
                            'Outpatient & Inpatient Services',
                            'Wellness & Preventive Programs'
                        ];
                        foreach($services as $svc):
                        ?>
                        <div class="flex items-center gap-3 bg-slate-50 p-2.5 rounded-md border border-slate-200">
                            <div class="w-6 h-6 rounded-md bg-white flex items-center justify-center shrink-0 border border-slate-200">
                                <svg class="w-3.5 h-3.5 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <span class="text-[11px] sm:text-xs font-bold text-slate-700"><?php echo $svc; ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action App Style (Flat Colors) -->
        <section class="bg-teal-900 rounded-md p-6 shadow-sm relative overflow-hidden flex flex-col items-center text-center mt-2 border border-teal-800">
            <div class="relative z-10 w-full max-w-lg">
                <h3 class="font-heading text-lg sm:text-xl font-extrabold text-white mb-2">Ready to Prioritize Your Health?</h3>
                <p class="text-teal-100 text-xs sm:text-sm mb-6">Book an appointment or visit us for compassionate, expert care today.</p>
                
                <div class="flex flex-col sm:flex-row gap-3 w-full">
                    <a href="<?php echo htmlspecialchars($LARAVEL_BOOKING_URL ?? '#'); ?>" class="flex-1 bg-white text-teal-900 active:bg-slate-100 px-4 py-3 rounded-md font-heading font-bold text-sm transition-colors border border-transparent">
                        Book Appointment
                    </a>
                    <a href="/contact-us" class="flex-1 bg-teal-800 text-white border border-teal-700 active:bg-teal-700 px-4 py-3 rounded-md font-heading font-bold text-sm transition-colors">
                        Contact Us
                    </a>
                </div>
            </div>
        </section>

    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
