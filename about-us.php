<?php
require_once __DIR__ . '/config/db.php';

$seo_title = 'About Us | Healing Touch Hospital, Purnea (Bihar)';
$seo_description = 'At Healing Touch Hospital, we are committed to providing compassionate, high-quality healthcare with a focus on patient well-being and comfort.';
$active_page = 'about';

include __DIR__ . '/includes/header.php';
?>

<div class="public-page min-h-screen bg-gray-50 font-sans text-gray-900 antialiased overflow-x-hidden pb-16 lg:pb-0 flex flex-col">
    <section class="bg-white py-12 sm:py-16 px-4 md:px-12 mt-6 lg:px-24 pt-28 sm:pt-32">
        <div class="max-w-6xl mx-auto text-left mb-10">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">About Healing Touch Hospital, Purnea (Bihar) </h1>
            <p class="text-lg text-gray-600 mb-8 max-w-4xl">
                At Healing Touch Hospital, we are committed to providing compassionate, high-quality healthcare with a focus on patient well-being and comfort.
            </p>
        </div>

        <!-- Mission & Services Section -->
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 mb-16 items-center">
            <div>
                <img src="/assets/images/heroImageHt.jpg" alt="Healing Touch Hospital" class="rounded-xl border border-gray-200 w-full" onerror="this.src='/assets/images/hospital-in-purnea-building.jpg'" />
            </div>
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Our Mission</h2>
                <p class="text-gray-600 mb-4">
                    Our mission is to deliver exceptional medical care with a human touch. We aim to create a healing environment where every patient is treated with dignity, respect, and empathy.
                </p>

                <h2 class="text-2xl font-semibold text-gray-800 mt-8 mb-4">Our Services</h2>
                <ul class="list-disc list-inside text-gray-600 space-y-2">
                    <li>24/7 Emergency Care</li>
                    <li>Advanced Diagnostics & Imaging</li>
                    <li>Specialized Surgical Services</li>
                    <li>Maternity & Childcare</li>
                    <li>Outpatient & Inpatient Services</li>
                    <li>Wellness & Preventive Programs</li>
                </ul>
            </div>
        </div>

        <!-- Final Call-to-Action -->
        <div class="max-w-6xl mx-auto mt-16 mb-12 text-left">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Ready to Prioritize Your Health?</h3>
            <p class="text-gray-600 mb-6">Book an appointment or visit us for compassionate, expert care today.</p>
            <a href="/contact-us.php" class="inline-block px-8 py-3 bg-beige-600 text-white font-medium rounded-lg border border-beige-600 hover:bg-beige-700 transition-colors">
                Contact Us
            </a>
        </div>
    </section>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
