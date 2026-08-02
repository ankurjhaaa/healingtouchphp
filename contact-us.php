<?php
require_once __DIR__ . '/config/db.php';

$seo_title = 'Contact Us | Healing Touch Hospital';
$seo_description = 'Get in touch with Healing Touch Hospital for appointments, inquiries, and emergency care.';
$active_page = 'contact';

// Site Settings / Defaults
$contact_phone = '+91 79038 93945';
$contact_email = 'healingtouchhospitalpurnea@gmail.com';
$whatsapp_number = '+91 79038 93945';
$address = "Healing Touch Hospital\nBypass Road, near bus stand\nPurnea, Bihar 854301\nIndia";
$map_url = 'https://maps.app.goo.gl/hG5o6V7oU2yW4T7C6';

include __DIR__ . '/includes/header.php';
?>

<div class="public-page min-h-screen bg-gray-50 font-sans text-gray-900 antialiased overflow-x-hidden pb-16 lg:pb-0 flex flex-col">
    <main class="flex-1 py-5 sm:py-8 px-4 sm:px-6 lg:px-8 max-w-6xl mt-16 mx-auto pt-20 sm:pt-24 w-full">
        <div class="mb-8 sm:mb-10 text-left">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Get in Touch</h1>
            <p class="text-gray-600 max-w-2xl">We're here to help and answer any questions you might have. We look forward to hearing from you.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <!-- Contact Information Card -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-md border border-gray-200 overflow-hidden">
                    <div class="bg-beige-600 py-4 px-5 relative border-b border-beige-700">
                        <div class="absolute right-0 top-0 w-24 h-24 bg-white opacity-10 rounded-full -translate-y-1/3 translate-x-1/3"></div>
                        <h3 class="text-xl font-bold text-white relative z-10">Contact Information</h3>
                    </div>

                    <div class="p-5">
                        <div class="grid sm:grid-cols-2 gap-6">
                            <!-- Phone Section -->
                            <div class="flex items-start min-w-0">
                                <div class="bg-beige-100 p-2.5 rounded-md mr-3 flex-shrink-0">
                                    <svg class="h-6 w-6 text-beige-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-gray-800 text-base">Phone</p>
                                    <a href="tel:<?php echo htmlspecialchars(str_replace(' ', '', $contact_phone)); ?>" class="text-beige-700 font-medium text-base hover:text-beige-800 transition-colors break-all"><?php echo htmlspecialchars($contact_phone); ?></a>
                                    <p class="text-gray-500 text-sm mt-1">Available 24/7 for emergencies</p>
                                </div>
                            </div>

                            <!-- Email Section -->
                            <div class="flex items-start min-w-0">
                                <div class="bg-beige-100 p-2.5 rounded-md mr-3 flex-shrink-0">
                                    <svg class="h-6 w-6 text-beige-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-gray-800 text-base">Email</p>
                                    <a href="mailto:<?php echo htmlspecialchars($contact_email); ?>" class="text-beige-700 font-medium text-base hover:text-beige-800 transition-colors break-all"><?php echo htmlspecialchars($contact_email); ?></a>
                                    <p class="text-gray-500 text-sm mt-1">We respond within 24 hours</p>
                                </div>
                            </div>

                            <!-- WhatsApp Section -->
                            <?php if($whatsapp_number): ?>
                            <div class="flex items-start min-w-0">
                                <div id="wa-icon-container" class="bg-gray-100 p-2.5 rounded-md mr-3 flex-shrink-0">
                                    <svg id="wa-icon" class="h-6 w-6 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                    </svg>
                                </div>
                                <div class="min-w-0" id="wa-content">
                                    <p class="font-semibold text-gray-800 text-base">WhatsApp</p>
                                    <!-- Populated by JS -->
                                </div>
                            </div>
                            <?php endif; ?>

                            <!-- Support Hours Section -->
                            <div class="flex items-start min-w-0">
                                <div class="bg-beige-100 p-2.5 rounded-md mr-3 flex-shrink-0">
                                    <svg class="h-6 w-6 text-beige-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m5-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-gray-800 text-base">Support Hours</p>
                                    <p class="text-gray-700">Monday - Saturday: 9:00 AM - 8:00 PM</p>
                                    <p class="text-gray-700">Sunday: Closed (Emergency Only)</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Address Section -->
                        <div class="mt-6 pt-5 border-t border-gray-200">
                            <div class="flex items-start min-w-0">
                                <div class="bg-beige-100 p-2.5 rounded-md mr-3 flex-shrink-0">
                                    <svg class="h-6 w-6 text-beige-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-gray-800 text-base">Address</p>
                                    <p class="text-gray-700 mt-1 whitespace-pre-line break-words"><?php echo htmlspecialchars($address); ?></p>
                                    <a href="<?php echo htmlspecialchars($map_url); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center text-beige-600 font-medium mt-2 hover:text-beige-800 transition-colors">
                                        Get Directions
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-md border border-gray-200 overflow-hidden h-full">
                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-gray-800 mb-4">Our Location</h3>
                        <div class="aspect-video relative rounded-md overflow-hidden border border-gray-200 min-h-[220px] sm:min-h-[300px]">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3573.094466674104!2d87.4907502!3d25.7888735!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eff90052a98551%3A0x4c8f3eaf163940d3!2sHealing%20Touch%20Hospital!5e0!3m2!1sen!2sin!4v1731949200000!5m2!1sen!2sin"
                                width="100%" height="100%" class="absolute inset-0" style="border: 0;"
                                allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                        <div class="bg-beige-50 rounded-md border border-beige-100 p-4 mt-4">
                            <p class="text-gray-700 text-sm">
                                <span class="font-medium">Visiting Hours:</span><br />
                                9:00 AM - 8:00 PM (Monday - Saturday)<br />
                                24/7 Emergency Services Available
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const checkAvailability = () => {
            const now = new Date();
            // Convert to Indian Standard Time (UTC+5:30)
            const istTime = new Date(now.getTime() + (5.5 * 60 * 60 * 1000));
            const currentHour = istTime.getUTCHours();
            
            const available = currentHour >= 8 && currentHour < 20;
            const waNumber = '<?php echo $whatsapp_number; ?>';
            const waNumberClean = waNumber.replace(/[^0-9]/g, '');
            
            const container = document.getElementById('wa-icon-container');
            const icon = document.getElementById('wa-icon');
            const content = document.getElementById('wa-content');
            
            let statusText = '';
            let innerHtml = `<p class="font-semibold text-gray-800 text-base">WhatsApp</p>`;
            
            if (available) {
                statusText = 'Quick chat support available (Online Now) - 8 AM to 8 PM IST';
                container.className = 'bg-green-100 p-2.5 rounded-md mr-3 flex-shrink-0';
                icon.className = 'h-6 w-6 text-green-600';
                
                innerHtml += `
                    <a href="https://wa.me/${waNumberClean}" target="_blank" rel="noopener noreferrer" class="text-green-600 font-medium text-base hover:text-green-800 transition-colors flex items-center break-all">
                        ${waNumber}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>
                `;
            } else {
                statusText = 'WhatsApp support is currently unavailable. Available from 8 AM to 8 PM IST';
                container.className = 'bg-gray-100 p-2.5 rounded-md mr-3 flex-shrink-0';
                icon.className = 'h-6 w-6 text-gray-500';
                
                innerHtml += `
                    <p class="text-red-500 text-sm mt-1">WhatsApp support is currently unavailable. Available from 8 AM to 8 PM IST.</p>
                `;
            }
            
            innerHtml += `<p class="text-gray-500 text-sm mt-1 break-words">${statusText}</p>`;
            content.innerHTML = innerHtml;
        };

        checkAvailability();
        setInterval(checkAvailability, 60000);
    });
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
