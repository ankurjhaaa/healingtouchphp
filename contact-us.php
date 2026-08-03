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

<!-- App Body Layout -->
<div class="bg-slate-50 min-h-screen pb-6 flex flex-col">
    <!-- Top Spacing -->
    <div class="h-4 lg:h-6"></div>

    <div class="container mx-auto px-4 max-w-7xl flex flex-col gap-4 lg:gap-6 flex-grow">
        
        <!-- App Header Banner (Flat) -->
        <section class="bg-slate-900 rounded-md p-6 relative overflow-hidden shadow-sm flex flex-col justify-center min-h-[140px] shrink-0 border border-slate-800">
            <div class="relative z-10 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-2 py-1 bg-teal-900/50 text-teal-400 rounded-md text-[10px] font-bold uppercase mb-2 border border-teal-800">
                    Support
                </div>
                <h1 class="font-heading text-2xl sm:text-3xl font-extrabold text-white mb-1 tracking-tight">Get in Touch</h1>
                <p class="text-slate-400 text-xs sm:text-sm">We're here to help and answer any questions you might have.</p>
            </div>
        </section>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-6">
            <!-- Contact Information Card -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-md p-4 sm:p-6 shadow-sm flex flex-col h-full border border-slate-200">
                    <h2 class="font-heading text-lg font-extrabold text-slate-900 mb-4">Contact Information</h2>
                    
                    <div class="grid sm:grid-cols-2 gap-4">
                        <!-- Phone Section -->
                        <div class="flex items-start bg-slate-50 p-3 rounded-md border border-slate-200">
                            <div class="w-10 h-10 rounded-md bg-white flex items-center justify-center shrink-0 mr-3 border border-slate-200 shadow-sm">
                                <svg class="h-4 w-4 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="font-bold text-slate-900 text-xs">Phone</p>
                                <a href="tel:<?php echo htmlspecialchars(str_replace(' ', '', $contact_phone)); ?>" class="text-teal-700 font-extrabold text-sm hover:text-teal-800 transition-colors block mt-0.5 truncate"><?php echo htmlspecialchars($contact_phone); ?></a>
                                <p class="text-slate-500 text-[10px] mt-1">Available 24/7</p>
                            </div>
                        </div>

                        <!-- Email Section -->
                        <div class="flex items-start bg-slate-50 p-3 rounded-md border border-slate-200">
                            <div class="w-10 h-10 rounded-md bg-white flex items-center justify-center shrink-0 mr-3 border border-slate-200 shadow-sm">
                                <svg class="h-4 w-4 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="font-bold text-slate-900 text-xs">Email</p>
                                <a href="mailto:<?php echo htmlspecialchars($contact_email); ?>" class="text-teal-700 font-extrabold text-[11px] sm:text-xs hover:text-teal-800 transition-colors block mt-0.5 truncate"><?php echo htmlspecialchars($contact_email); ?></a>
                                <p class="text-slate-500 text-[10px] mt-1">Response in 24h</p>
                            </div>
                        </div>

                        <!-- WhatsApp Section -->
                        <?php if($whatsapp_number): ?>
                        <div class="flex items-start bg-slate-50 p-3 rounded-md border border-slate-200">
                            <div id="wa-icon-container" class="w-10 h-10 rounded-md bg-white flex items-center justify-center shrink-0 mr-3 border border-slate-200 shadow-sm">
                                <svg id="wa-icon" class="h-4 w-4 text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1" id="wa-content">
                                <p class="font-bold text-slate-900 text-xs">WhatsApp</p>
                                <!-- Populated by JS -->
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Support Hours Section -->
                        <div class="flex items-start bg-slate-50 p-3 rounded-md border border-slate-200">
                            <div class="w-10 h-10 rounded-md bg-white flex items-center justify-center shrink-0 mr-3 border border-slate-200 shadow-sm">
                                <svg class="h-4 w-4 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m5-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="font-bold text-slate-900 text-xs">Hours</p>
                                <p class="text-slate-600 font-medium text-xs mt-0.5">Mon-Sat: 9AM-8PM</p>
                                <p class="text-slate-500 text-[10px] mt-1">Sun: Emergency Only</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Address Section -->
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <div class="flex items-start bg-slate-50 p-3 rounded-md border border-slate-200">
                            <div class="w-10 h-10 rounded-md bg-white flex items-center justify-center shrink-0 mr-3 border border-slate-200 shadow-sm">
                                <svg class="h-4 w-4 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="font-bold text-slate-900 text-xs">Address</p>
                                <p class="text-slate-500 font-medium mt-1 text-xs whitespace-pre-line"><?php echo htmlspecialchars($address); ?></p>
                                <a href="<?php echo htmlspecialchars($map_url); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center text-teal-700 font-bold text-[10px] uppercase tracking-wider mt-3 bg-teal-50/50 hover:bg-teal-100 px-3 py-1.5 rounded-md border border-teal-100 transition-colors">
                                    Get Directions
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-md shadow-sm p-2 flex flex-col h-full min-h-[300px] border border-slate-200">
                    <div class="flex-grow w-full rounded-md overflow-hidden bg-slate-100 relative border border-slate-200">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3573.094466674104!2d87.4907502!3d25.7888735!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eff90052a98551%3A0x4c8f3eaf163940d3!2sHealing%20Touch%20Hospital!5e0!3m2!1sen!2sin!4v1731949200000!5m2!1sen!2sin"
                            width="100%" height="100%" class="absolute inset-0 border-0"
                            allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            
            const icon = document.getElementById('wa-icon');
            const content = document.getElementById('wa-content');
            
            if(!icon || !content) return;

            let statusText = '';
            let innerHtml = `<p class="font-bold text-slate-900 text-xs">WhatsApp</p>`;
            
            if (available) {
                statusText = 'Quick chat support available';
                icon.className = 'h-4 w-4 text-teal-600';
                
                innerHtml += `
                    <a href="https://wa.me/${waNumberClean}" target="_blank" rel="noopener noreferrer" class="text-teal-700 font-extrabold text-sm hover:text-teal-800 transition-colors flex items-center truncate mt-0.5">
                        ${waNumber}
                    </a>
                `;
            } else {
                statusText = 'Available 8 AM - 8 PM';
                icon.className = 'h-4 w-4 text-slate-400';
                
                innerHtml += `
                    <p class="text-rose-500 text-xs mt-1 font-bold">Currently Unavailable</p>
                `;
            }
            
            innerHtml += `<p class="text-slate-500 text-[10px] mt-1">${statusText}</p>`;
            content.innerHTML = innerHtml;
        };

        checkAvailability();
        setInterval(checkAvailability, 60000);
    });
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
