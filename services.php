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
        'description' => 'Our multispeciality care unit provides expert consultation and treatment across cardiology, orthopedics, gynecology, and more.'
    ],
    [
        'id' => 'icu',
        'name' => 'ICU',
        'title' => 'ICU Services',
        'image' => '/assets/images/hospital3.jpg',
        'description' => 'Our ICU provides advanced critical care and continuous monitoring for seriously ill patients and post-surgery recovery.'
    ],
    [
        'id' => 'nicu',
        'name' => 'NICU',
        'title' => 'NICU Services',
        'image' => '/assets/images/hospital4.jpg',
        'description' => 'Our NICU offers specialized support for premature and critically ill newborns with expert neonatal supervision.'
    ],
    [
        'id' => 'ultrasound',
        'name' => 'Ultrasound',
        'title' => 'Ultrasound Services',
        'image' => '/assets/images/hospital5.jpg',
        'description' => 'We provide accurate ultrasound diagnostics for timely monitoring and treatment planning.'
    ],
    [
        'id' => 'neurosurgery',
        'name' => 'Neurosurgery',
        'title' => 'Neurosurgery',
        'image' => '/assets/images/hospital6.jpg',
        'description' => 'Our neurosurgery team handles complex brain and spine procedures with modern surgical care.'
    ],
    [
        'id' => 'x-ray',
        'name' => 'X-RAY',
        'title' => 'X-RAY Services',
        'image' => '/assets/images/hospital7.jpg',
        'description' => 'Fast and reliable X-ray imaging services for injury assessment and medical diagnosis.'
    ],
    [
        'id' => 'pathology',
        'name' => 'Pathology',
        'title' => 'Pathology Services',
        'image' => '/assets/images/hospital8.jpg',
        'description' => 'Comprehensive pathology testing with dependable reports for quick clinical decisions.'
    ],
    [
        'id' => 'painless-normal-delivery',
        'name' => 'Painless Delivery',
        'title' => 'Painless Normal Delivery',
        'image' => '/assets/images/hospital3.jpg',
        'description' => 'We offer painless normal delivery options for a safer, more comfortable childbirth experience.'
    ],
    [
        'id' => '24-hrs-delivery-service',
        'name' => '24 Hrs Delivery',
        'title' => '24 hrs Delivery Service',
        'image' => '/assets/images/hospital5.jpg',
        'description' => 'Round-the-clock delivery support ensures access to expert maternity care any time.'
    ],
];
?>

<div class="public-page min-h-screen bg-gray-50 font-sans text-gray-900 antialiased overflow-x-hidden pb-24 lg:pb-0 flex flex-col">
    <main id="services" class="flex-1 py-8 sm:py-12 pt-24 sm:pt-28 w-full">
        <div class="mx-auto w-full max-w-6xl px-4 sm:px-6">
            <div class="text-center mb-8 sm:mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Our Medical Services</h1>
                <p class="text-gray-600 max-w-3xl mx-auto">Choose a service below to instantly see details. Built for fast browsing on mobile like an app.</p>
            </div>

            <div class="flex flex-col lg:flex-row gap-6 lg:gap-8">
                <div class="lg:w-2/3 w-full">
                    <div class="bg-white rounded-md border border-gray-200 shadow-sm p-3 sm:p-4">
                        <div class="mb-3 flex items-center justify-between">
                            <h2 class="text-base sm:text-lg font-bold text-gray-800">Browse Services</h2>
                            <span class="text-xs text-gray-500">Tap service name</span>
                        </div>
                        <div class="flex gap-2 overflow-x-auto pb-2 snap-x snap-mandatory [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                            <?php foreach ($services as $index => $service): ?>
                                <button
                                    type="button"
                                    onclick="selectService('<?php echo $service['id']; ?>')"
                                    id="btn-<?php echo $service['id']; ?>"
                                    class="service-btn snap-start shrink-0 rounded-full border px-4 py-2 text-sm font-semibold transition-colors <?php echo $index === 0 ? 'bg-beige-600 border-beige-600 text-white' : 'bg-white border-gray-200 text-gray-700 hover:bg-beige-50 hover:border-beige-200'; ?>"
                                >
                                    <?php echo htmlspecialchars($service['name']); ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div id="service-display" class="mt-4 bg-white rounded-md border border-gray-200 overflow-hidden shadow-sm">
                        <div class="relative h-52 sm:h-64 bg-gray-200">
                            <img id="service-img" src="<?php echo $services[0]['image']; ?>" alt="<?php echo $services[0]['title']; ?>" class="absolute inset-0 h-full w-full object-cover object-center" />
                        </div>
                        <div class="p-4 sm:p-6">
                            <h3 id="service-title" class="text-xl sm:text-2xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($services[0]['title']); ?></h3>
                            <p id="service-desc" class="text-gray-600 text-sm sm:text-base leading-relaxed"><?php echo htmlspecialchars($services[0]['description']); ?></p>
                        </div>
                    </div>
                </div>

                <aside class="lg:w-1/3 w-full space-y-4">
                    <div class="bg-white rounded-md border border-gray-200 shadow-sm p-4 sm:p-5">
                        <h4 class="font-bold text-base text-gray-800 mb-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-beige-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Operating Hours
                        </h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Monday - Friday</span>
                                <span class="font-medium text-beige-600">8:00 AM - 6:00 PM</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Saturday</span>
                                <span class="font-medium text-beige-600">9:00 AM - 4:00 PM</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Sunday</span>
                                <span class="font-medium text-beige-600">Closed</span>
                            </div>
                        </div>
                        <div class="mt-3 bg-beige-50 border border-beige-100 rounded-md p-2.5">
                            <p class="text-beige-800 text-xs sm:text-sm flex items-center">
                                <span class="text-red-600 mr-2">🚨</span>
                                Emergency care available 24/7
                            </p>
                        </div>
                    </div>

                    <div class="hidden lg:block bg-white rounded-md border border-gray-200 shadow-sm p-4 sm:p-5 sticky top-24">
                        <h4 class="font-bold text-gray-800 mb-2">Need Help?</h4>
                        <p class="text-gray-600 text-sm mb-3">Contact us for appointments or questions.</p>
                        <a href="/contact-us.php" class="bg-beige-600 hover:bg-beige-700 text-white text-center rounded-md border border-beige-600 py-2.5 px-4 block transition-colors duration-150 w-full">
                            Call Now
                        </a>
                    </div>
                </aside>
            </div>
        </div>
    </main>

    <div class="lg:hidden fixed bottom-20 right-4 z-40">
        <a href="/contact-us.php" class="inline-flex items-center gap-2 bg-beige-600 hover:bg-beige-700 text-white rounded-full border border-beige-600 py-3 px-4 shadow-lg transition-colors duration-150">
            <span class="text-base">📞</span>
            <span class="text-sm font-semibold">Need Help? Call Now</span>
        </a>
    </div>
</div>

<script>
    const servicesData = <?php echo json_encode($services); ?>;

    function selectService(id) {
        // Update buttons
        document.querySelectorAll('.service-btn').forEach(btn => {
            btn.className = "service-btn snap-start shrink-0 rounded-full border px-4 py-2 text-sm font-semibold transition-colors bg-white border-gray-200 text-gray-700 hover:bg-beige-50 hover:border-beige-200";
        });
        const activeBtn = document.getElementById('btn-' + id);
        if (activeBtn) {
            activeBtn.className = "service-btn snap-start shrink-0 rounded-full border px-4 py-2 text-sm font-semibold transition-colors bg-beige-600 border-beige-600 text-white";
        }

        // Update display
        const service = servicesData.find(s => s.id === id);
        if (service) {
            document.getElementById('service-img').src = service.image;
            document.getElementById('service-title').innerText = service.title;
            document.getElementById('service-desc').innerText = service.description;
        }
    }
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
