<?php
require_once __DIR__ . '/config/db.php';

$slug = isset($_GET['slug']) ? trim($_GET['slug']) : 'hospital';
$prefix = isset($_GET['prefix']) ? trim($_GET['prefix']) : '';
$suffix = isset($_GET['suffix']) ? trim($_GET['suffix']) : '';

// Create a nice readable title from slug
$clean_slug = ucwords(str_replace('-', ' ', $slug));

$seo_keyword = "";
if ($prefix) {
    $seo_keyword = "$prefix $clean_slug in Purnea";
} else if ($suffix) {
    $seo_keyword = "$clean_slug $suffix in Purnea";
} else {
    $seo_keyword = "Best $clean_slug in Purnea";
}

$seo_title = "$seo_keyword | Healing Touch Hospital";
$seo_description = "Looking for $seo_keyword? Healing Touch Hospital provides world-class facilities and top specialists in Purnea. Book an appointment today!";
$active_page = 'home';

// Try to find a matching department to show specific doctors
$departments = [];
try {
    $stmt = $pdo->prepare("SELECT id, name FROM departments WHERE name IS NOT NULL");
    $stmt->execute();
    $departments = $stmt->fetchAll();
} catch (Exception $e) {}

// Synonyms for colloquial / real-world searches
$synonyms = [
    'heart-doctor' => 'Cardiology',
    'heart-specialist' => 'Cardiology',
    'haddi-doctor' => 'Orthopedics',
    'bone-doctor' => 'Orthopedics',
    'orthopedic-surgeon' => 'Orthopedics',
    'child-doctor' => 'Pediatrics',
    'child-specialist' => 'Pediatrics',
    'bacho-ka-doctor' => 'Pediatrics',
    'lady-doctor' => 'Gynecology',
    'pregnancy-doctor' => 'Gynecology',
    'skin-doctor' => 'Dermatology',
    'hair-doctor' => 'Dermatology',
    'brain-doctor' => 'Neurology',
    'neuro-doctor' => 'Neurology',
    'stomach-doctor' => 'Gastroenterology',
    'pet-ka-doctor' => 'Gastroenterology',
    'sugar-doctor' => 'General Medicine',
    'fever-doctor' => 'General Medicine'
];

$matched_dept_id = null;
$matched_dept_name = null;
$search_target = strtolower($slug);

// If the slug matches a synonym, use the mapped department name for the search target
if (isset($synonyms[$search_target])) {
    $search_target = strtolower($synonyms[$search_target]);
}

foreach ($departments as $dept) {
    // If the search target is found within the department name
    if (stripos($search_target, strtolower($dept['name'])) !== false || stripos(strtolower($dept['name']), $search_target) !== false) {
        $matched_dept_id = $dept['id'];
        $matched_dept_name = $dept['name'];
        break;
    }
}

// Fetch doctors
$doctors = [];
try {
    if ($matched_dept_id) {
        $doc_stmt = $pdo->prepare("
            SELECT u.name, d.image, d.qualification, d.slug, dep.name as department_name 
            FROM users u 
            INNER JOIN doctors d ON u.id = d.user_id 
            LEFT JOIN departments dep ON d.department_id = dep.id 
            WHERE (d.status = 1 OR d.status = '1') AND d.department_id = ?
            LIMIT 6
        ");
        $doc_stmt->execute([$matched_dept_id]);
    } else {
        // Fallback to top doctors
        $doc_stmt = $pdo->prepare("
            SELECT u.name, d.image, d.qualification, d.slug, dep.name as department_name 
            FROM users u 
            INNER JOIN doctors d ON u.id = d.user_id 
            LEFT JOIN departments dep ON d.department_id = dep.id 
            WHERE (d.status = 1 OR d.status = '1')
            LIMIT 6
        ");
        $doc_stmt->execute();
    }
    $doctors = $doc_stmt->fetchAll();
} catch (Exception $e) {}

include __DIR__ . '/includes/header.php';
?>

<div class="bg-slate-50 min-h-screen">
    <!-- SEO Hero Section -->
    <section class="bg-slate-900 text-white pb-20 pt-10 md:pt-20 md:pb-32 px-4 relative overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-30 mix-blend-overlay">
            <img src="/assets/images/hospital-in-purnea-hero.jpg" class="w-full h-full object-cover" alt="<?php echo htmlspecialchars($seo_keyword); ?>">
        </div>
        <div class="absolute inset-0 bg-teal-950/80 z-0"></div>
        <div class="container mx-auto max-w-4xl relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-md bg-teal-800/80 text-teal-100 text-[10px] font-bold uppercase tracking-widest mb-4 border border-teal-700">
                Top Rated in Purnea
            </div>
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-extrabold font-heading mb-4 leading-tight">
                <?php echo htmlspecialchars($seo_keyword); ?>
            </h1>
            <p class="text-teal-50 text-sm md:text-lg mb-8 max-w-2xl mx-auto leading-relaxed">
                Welcome to Healing Touch Hospital, recognized as the premier destination for your healthcare needs in Purnea. Our experienced specialists and state-of-the-art facilities ensure you get the best treatment.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo htmlspecialchars($LARAVEL_BOOKING_URL); ?>" class="bg-teal-500 hover:bg-teal-400 text-slate-900 px-6 py-3.5 rounded-md font-bold text-sm uppercase tracking-wide transition-colors">
                    Book Appointment Now
                </a>
                <a href="tel:+917903893945" class="bg-white/10 hover:bg-white/20 border border-white/20 text-white px-6 py-3.5 rounded-md font-bold text-sm uppercase tracking-wide transition-colors flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                    Call Helpline
                </a>
            </div>
        </div>
    </section>

    <!-- Content & Doctors -->
    <div class="container mx-auto px-4 max-w-6xl -mt-12 relative z-20 pb-16">
        
        <div class="bg-white rounded-md shadow-sm border border-slate-200 p-6 md:p-10 mb-8 text-slate-700 leading-relaxed text-sm md:text-base">
            <h2 class="font-heading font-extrabold text-2xl text-slate-900 mb-4">Why choose us for <?php echo htmlspecialchars($clean_slug); ?>?</h2>
            <p class="mb-4">
                At Healing Touch Hospital in Purnea, we believe in patient-first care. Our highly qualified medical professionals combine years of experience with modern technology to deliver unmatched results. Whether you are looking for consultation or advanced surgical procedures, our facility is equipped to handle complex medical needs.
            </p>
            <ul class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6 text-sm">
                <li class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-teal-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                    Highly Experienced Specialists
                </li>
                <li class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-teal-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                    24/7 Emergency Support
                </li>
                <li class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-teal-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                    Modern Infrastructure
                </li>
                <li class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-teal-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                    Affordable & Transparent Pricing
                </li>
            </ul>
        </div>

        <?php if(count($doctors) > 0): ?>
        <div class="mb-6 flex justify-between items-end">
            <div>
                <h2 class="text-xl md:text-2xl font-extrabold text-slate-900 font-heading">Our Specialists</h2>
                <p class="text-slate-500 text-sm mt-1">Meet our dedicated experts</p>
            </div>
            <a href="/our-doctors" class="text-teal-700 font-bold text-sm hover:text-teal-800">View All</a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php foreach($doctors as $doctor): ?>
            <div class="doctor-card bg-white rounded-md shadow-sm border border-slate-200 flex flex-col hover:shadow-md transition-shadow overflow-hidden">
                <div class="p-4 flex items-start gap-4">
                    <div class="w-16 h-20 rounded-md overflow-hidden shrink-0 bg-slate-100 border border-slate-200">
                        <img src="<?php echo htmlspecialchars($doctor['image'] ?? '/assets/images/default.jpg'); ?>" alt="Dr. <?php echo htmlspecialchars($doctor['name']); ?>" class="w-full h-full object-cover">
                    </div>
                    <div class="min-w-0 flex-1 pt-1">
                        <h3 class="font-heading font-extrabold text-slate-900 text-base mb-1 truncate">Dr. <?php echo htmlspecialchars($doctor['name']); ?></h3>
                        <div class="inline-flex items-center px-2 py-1 rounded-md bg-teal-50 border border-teal-100 mb-1.5">
                            <span class="text-teal-700 text-[9px] font-bold uppercase tracking-wider truncate"><?php echo htmlspecialchars($doctor['department_name'] ?? 'General'); ?></span>
                        </div>
                        <p class="text-slate-500 text-[11px] truncate leading-tight" title="<?php echo htmlspecialchars(is_string($doctor['qualification']) ? str_replace('"', '', trim($doctor['qualification'], '[]')) : '-'); ?>">
                            <?php echo htmlspecialchars(is_string($doctor['qualification']) ? str_replace('"', '', trim($doctor['qualification'], '[]')) : '-'); ?>
                        </p>
                    </div>
                </div>
                
                <div class="flex border-t border-slate-200 bg-slate-50 mt-auto">
                    <a href="/doctor-details?slug=<?php echo urlencode($doctor['slug']); ?>" class="flex-1 py-3 text-center text-[11px] font-bold text-slate-700 hover:text-teal-700 transition-colors border-r border-slate-200">Profile</a>
                    <a href="<?php echo htmlspecialchars($LARAVEL_BOOKING_URL ?? '#'); ?>/?slug=<?php echo urlencode($doctor['slug']); ?>" class="flex-1 py-3 text-center text-[11px] font-bold text-teal-700 hover:text-teal-800 transition-colors">Book Now</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Pagination goes here if needed -->
    </div>
</div>

<?php 
// Add specific MedicalClinic Schema for programmatic SEO
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$domainName = $_SERVER['HTTP_HOST'];
$current_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$canonical_url = $protocol . $domainName . $current_path;
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "MedicalClinic",
  "name": "<?php echo htmlspecialchars($seo_keyword); ?> | Healing Touch Hospital",
  "url": "<?php echo htmlspecialchars($canonical_url); ?>",
  "logo": "<?php echo $protocol . $domainName; ?>/assets/images/healingTouchLogo.jpeg",
  "image": "<?php echo $protocol . $domainName; ?>/assets/images/healingTouchLogo.jpeg",
  "description": "<?php echo htmlspecialchars($seo_description); ?>",
  "medicalSpecialty": "<?php echo htmlspecialchars($clean_slug); ?>",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Bypass Road, near bus stand",
    "addressLocality": "Purnea",
    "addressRegion": "Bihar",
    "postalCode": "854301",
    "addressCountry": "IN"
  },
  "parentOrganization": {
    "@type": "MedicalOrganization",
    "name": "Healing Touch Hospital Purnea",
    "url": "<?php echo $protocol . $domainName; ?>/"
  }
}
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
