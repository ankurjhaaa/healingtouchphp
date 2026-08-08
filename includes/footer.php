    </main>

    <footer class="mt-auto bg-slate-900 text-slate-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
                <!-- Brand Info -->
                <div class="lg:col-span-1">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="bg-white p-1 rounded-md">
                            <img src="/assets/images/healingTouchLogo.jpeg" alt="Logo" class="h-8 w-8 rounded-md object-cover">
                        </div>
                        <h3 class="font-heading font-bold text-xl text-white tracking-tight">
                            <span class="text-teal-400">Healing</span> Touch
                        </h3>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed mb-6">
                        Providing compassionate, accessible healthcare with trusted specialists and modern medical facilities in Purnea.
                    </p>
                    <!-- Social Links placeholder -->
                    <div class="flex items-center gap-3">
                        <a href="#" class="w-8 h-8 rounded-md bg-slate-800 flex items-center justify-center hover:bg-teal-600 hover:text-white transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-md bg-slate-800 flex items-center justify-center hover:bg-teal-600 hover:text-white transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-heading font-semibold text-white mb-4 text-lg">Quick Links</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="/" class="hover:text-teal-400 transition-colors flex items-center gap-2"><span class="w-1 h-1 rounded-md bg-slate-600"></span> Home</a></li>
                        <li><a href="/our-doctors" class="hover:text-teal-400 transition-colors flex items-center gap-2"><span class="w-1 h-1 rounded-md bg-slate-600"></span> Find a Doctor</a></li>
                        <li><a href="/services" class="hover:text-teal-400 transition-colors flex items-center gap-2"><span class="w-1 h-1 rounded-md bg-slate-600"></span> Our Services</a></li>
                        <li><a href="<?php echo htmlspecialchars($LARAVEL_BOOKING_URL); ?>" class="hover:text-teal-400 transition-colors flex items-center gap-2"><span class="w-1 h-1 rounded-md bg-slate-600"></span> Book Appointment</a></li>
                        <li><a href="/contact-us" class="hover:text-teal-400 transition-colors flex items-center gap-2"><span class="w-1 h-1 rounded-md bg-slate-600"></span> Contact Us</a></li>
                    </ul>
                </div>

                <!-- Portals -->
                <div>
                    <h4 class="font-heading font-semibold text-white mb-4 text-lg">Login Portals</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="https://healingtouchpurnea.com/login" class="hover:text-teal-400 transition-colors flex items-center gap-2"><span class="w-1 h-1 rounded-md bg-slate-600"></span> Patient Login</a></li>
                        <li><a href="https://healingtouchpurnea.com/doctor/login" class="hover:text-teal-400 transition-colors flex items-center gap-2"><span class="w-1 h-1 rounded-md bg-slate-600"></span> Doctor Portal</a></li>
                        <li><a href="https://healingtouchpurnea.com/reception/login" class="hover:text-teal-400 transition-colors flex items-center gap-2"><span class="w-1 h-1 rounded-md bg-slate-600"></span> Reception Login</a></li>
                        <li><a href="https://healingtouchpurnea.com/admin/login" class="hover:text-teal-400 transition-colors flex items-center gap-2"><span class="w-1 h-1 rounded-md bg-slate-600"></span> Admin Login</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="font-heading font-semibold text-white mb-4 text-lg">Get in Touch</h4>
                    <ul class="space-y-4 text-sm text-slate-400">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-teal-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            <span>Bypass Road, near bus stand<br>Purnea, Bihar 854301, India</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-teal-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            <a href="tel:+917903893945" class="hover:text-teal-400 transition-colors">+91 79038 93945</a>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-teal-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            <a href="mailto:healingtouchhospitalpurnea@gmail.com" class="hover:text-teal-400 transition-colors break-all">healingtouchhospitalpurnea@gmail.com</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-slate-800 text-xs text-slate-500 flex flex-col md:flex-row justify-between items-center gap-4">
                <p>© <?php echo date('Y'); ?> Healing Touch Hospital. All rights reserved.</p>
                <div class="flex gap-4">
                    <a href="/privacy-policy" class="hover:text-slate-300 transition-colors">Privacy Policy</a>
                    <a href="/terms-conditions" class="hover:text-slate-300 transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>

        <!-- Programmatic SEO Links (Screen Reader Only) -->
        <div class="sr-only">
            <h2>Popular Searches in Purnea</h2>
            <ul>
                <?php 
                try {
                    global $pdo;
                    if (isset($pdo)) {
                        $seo_stmt = $pdo->query("SELECT name FROM departments WHERE name IS NOT NULL");
                        while ($row = $seo_stmt->fetch()) {
                            $d_slug = strtolower(str_replace(' ', '-', trim($row['name'])));
                            echo "<li><a href='/best-{$d_slug}-in-purnea'>Best {$row['name']} in Purnea</a></li>";
                            echo "<li><a href='/top-{$d_slug}-in-purnea'>Top {$row['name']} in Purnea</a></li>";
                            echo "<li><a href='/{$d_slug}-hospital-in-purnea'>{$row['name']} Hospital in Purnea</a></li>";
                            echo "<li><a href='/{$d_slug}-specialist-in-purnea'>{$row['name']} Specialist in Purnea</a></li>";
                            echo "<li><a href='/{$d_slug}-treatment-in-purnea'>{$row['name']} Treatment in Purnea</a></li>";
                            echo "<li><a href='/{$d_slug}-clinic-in-purnea'>{$row['name']} Clinic in Purnea</a></li>";
                        }
                    }
                    
                    // Add real-world colloquial terms for deep crawling
                    $synonyms = [
                        'heart-doctor', 'heart-specialist', 'haddi-doctor', 'bone-doctor', 
                        'orthopedic-surgeon', 'child-doctor', 'child-specialist', 'bacho-ka-doctor',
                        'lady-doctor', 'pregnancy-doctor', 'skin-doctor', 'hair-doctor', 
                        'brain-doctor', 'neuro-doctor', 'stomach-doctor', 'pet-ka-doctor', 
                        'sugar-doctor', 'fever-doctor'
                    ];
                    
                    foreach ($synonyms as $term) {
                        $clean_name = ucwords(str_replace('-', ' ', $term));
                        echo "<li><a href='/best-{$term}-in-purnea'>Best {$clean_name} in Purnea</a></li>";
                        echo "<li><a href='/top-{$term}-in-purnea'>Top {$clean_name} in Purnea</a></li>";
                    }
                } catch (Exception $e) {}
                ?>
            </ul>
        </div>
    </footer>

    <!-- jQuery for AJAX / Booking logic -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <?php
    // Check if current time in IST is between 7 AM and 6 PM (18:00)
    $ist_timezone = new DateTimeZone('Asia/Kolkata');
    $current_time = new DateTime('now', $ist_timezone);
    $current_hour = (int)$current_time->format('G'); // 0 to 23

    $show_call_button = ($current_hour >= 7 && $current_hour < 18);
    ?>

    <?php if ($show_call_button): ?>
    <!-- Floating Call Button (Visible 7 AM to 6 PM) -->
    <div class="fixed right-4 lg:right-6 bottom-[88px] lg:bottom-6 z-40">
        <a href="tel:+917903893945" class="relative flex items-center justify-center w-14 h-14 bg-teal-600 text-white rounded-full shadow-lg hover:bg-teal-700 hover:scale-110 transition-transform duration-300">
            <!-- Ping animation behind the button -->
            <span class="absolute inline-flex h-full w-full rounded-full bg-teal-500 opacity-30 animate-ping"></span>
            <svg class="w-6 h-6 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
        </a>
    </div>
    <?php endif; ?>
</body>
</html>
