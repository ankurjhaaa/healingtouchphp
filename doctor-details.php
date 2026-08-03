<?php
require_once __DIR__ . '/config/db.php';

$slug = $_GET['slug'] ?? '';
if (empty($slug)) {
    header("Location: /our-doctors.php");
    exit;
}

$doctor = null;
try {
    $stmt = $pdo->prepare("
        SELECT u.name, d.image, d.qualification, d.available_days, d.fee, d.slug, dep.name as department_name 
        FROM users u 
        INNER JOIN doctors d ON u.id = d.user_id 
        LEFT JOIN departments dep ON d.department_id = dep.id 
        WHERE d.slug = ? AND (d.status = 1 OR d.status = '1')
    ");
    $stmt->execute([$slug]);
    $doctor = $stmt->fetch();
} catch (Exception $e) {
    // ignore
}

if (!$doctor) {
    header("Location: /our-doctors.php");
    exit;
}

$seo_title = 'Dr. ' . htmlspecialchars($doctor['name']) . ' | Healing Touch Hospital';
$seo_description = 'Book an appointment with Dr. ' . htmlspecialchars($doctor['name']) . ' at Healing Touch Hospital.';
$active_page = 'doctors';

include __DIR__ . '/includes/header.php';

$qualification = is_string($doctor['qualification']) ? str_replace('"', '', trim($doctor['qualification'], '[]')) : '-';
$availableDays = is_string($doctor['available_days']) ? str_replace('"', '', trim($doctor['available_days'], '[]')) : '';
$daysList = $availableDays ? explode(',', $availableDays) : [];
$fee = $doctor['fee'] ? $doctor['fee'] : '-';
?>

<!-- App Body Layout -->
<div class="bg-slate-50 min-h-screen pb-6 flex flex-col">
    <!-- Top Spacing -->
    <div class="h-4 lg:h-6"></div>

    <div class="container mx-auto px-4 max-w-7xl flex flex-col gap-4 lg:gap-6 flex-grow">
        
        <a href="/our-doctors.php"
            class="inline-flex items-center text-sm text-teal-700 font-bold hover:text-teal-800 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Back to Doctors
        </a>

        <div class="mt-2 bg-white rounded-md border border-slate-200 shadow-sm overflow-hidden flex flex-col">
            <div class="bg-slate-50 border-b border-slate-200 px-5 sm:px-6 py-5">
                <div class="flex flex-col sm:flex-row sm:items-start gap-5">
                    <img src="<?php echo htmlspecialchars($doctor['image'] ?? '/assets/images/default.jpg'); ?>"
                        alt="<?php echo htmlspecialchars($doctor['name']); ?>"
                        class="w-24 h-24 sm:w-28 sm:h-32 rounded-md object-cover border border-slate-200 shadow-sm shrink-0 bg-white" />

                    <div class="flex-1 pt-1">
                        <h1 class="text-2xl sm:text-3xl font-heading font-extrabold text-slate-900">Dr. <?php echo htmlspecialchars($doctor['name']); ?></h1>
                        <div class="inline-flex items-center px-2 py-1 rounded-md bg-teal-50 border border-teal-100 mt-2 mb-2">
                            <span class="text-teal-700 text-xs font-bold uppercase tracking-wider"><?php echo htmlspecialchars($doctor['department_name'] ?? '-'); ?></span>
                        </div>
                        <div class="mt-2 flex flex-wrap gap-2 text-xs">
                            <span class="px-3 py-1.5 rounded-md bg-white text-slate-700 border border-slate-200 font-bold shadow-sm">
                                ₹<?php echo htmlspecialchars($fee); ?>
                            </span>
                            <span class="px-3 py-1.5 rounded-md bg-white text-slate-700 border border-slate-200 font-bold shadow-sm">
                                <?php echo htmlspecialchars($qualification); ?>
                            </span>
                        </div>
                    </div>

                    <a href="<?php echo htmlspecialchars($LARAVEL_BOOKING_URL); ?>/?slug=<?php echo urlencode($doctor['slug']); ?>" 
                        class="inline-flex items-center justify-center bg-teal-700 hover:bg-teal-800 text-white px-5 py-3 rounded-md font-bold shadow-sm self-start w-full sm:w-auto transition-colors mt-4 sm:mt-0">
                        Book Appointment
                    </a>
                </div>
            </div>

            <div class="p-5 sm:p-6 grid grid-cols-1 lg:grid-cols-3 gap-6 bg-white">
                <div class="lg:col-span-2 space-y-5">
                    <div class="rounded-md bg-slate-50 border border-slate-200 p-5">
                        <h2 class="text-lg font-heading font-extrabold text-slate-900 mb-4">Doctor Information</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex items-start gap-3 bg-white p-3 rounded-md border border-slate-100 shadow-sm">
                                <div class="w-10 h-10 rounded-md bg-slate-50 flex items-center justify-center border border-slate-200 shrink-0">
                                    <svg class="w-5 h-5 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase font-bold tracking-wider text-slate-500">Department</p>
                                    <p class="font-bold text-slate-900 text-sm mt-0.5">
                                        <?php echo htmlspecialchars($doctor['department_name'] ?? '-'); ?></p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 bg-white p-3 rounded-md border border-slate-100 shadow-sm">
                                <div class="w-10 h-10 rounded-md bg-slate-50 flex items-center justify-center border border-slate-200 shrink-0">
                                    <svg class="w-5 h-5 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" /></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase font-bold tracking-wider text-slate-500">Qualification</p>
                                    <p class="font-bold text-slate-900 text-sm mt-0.5 truncate" title="<?php echo htmlspecialchars($qualification); ?>">
                                        <?php echo htmlspecialchars($qualification); ?></p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 bg-white p-3 rounded-md border border-slate-100 shadow-sm">
                                <div class="w-10 h-10 rounded-md bg-slate-50 flex items-center justify-center border border-slate-200 shrink-0">
                                    <svg class="w-5 h-5 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase font-bold tracking-wider text-slate-500">Consultation Fee</p>
                                    <p class="font-bold text-slate-900 text-sm mt-0.5">₹<?php echo htmlspecialchars($fee); ?></p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 bg-white p-3 rounded-md border border-slate-100 shadow-sm">
                                <div class="w-10 h-10 rounded-md bg-slate-50 flex items-center justify-center border border-slate-200 shrink-0">
                                    <svg class="w-5 h-5 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase font-bold tracking-wider text-slate-500">Available Days</p>
                                    <p class="font-bold text-slate-900 text-xs mt-0.5">
                                        <?php echo count($daysList) ? htmlspecialchars(implode(', ', $daysList)) : 'Not specified'; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-md bg-white border border-slate-200 p-5 shadow-sm">
                        <h2 class="text-lg font-heading font-extrabold text-slate-900 mb-3">About Dr. <?php echo htmlspecialchars($doctor['name']); ?></h2>
                        <p class="text-slate-600 leading-relaxed text-sm">
                            Dr. <?php echo htmlspecialchars($doctor['name']); ?> is a highly skilled healthcare
                            professional with comprehensive training and experience in the field of
                            <?php echo htmlspecialchars($doctor['department_name'] ?? 'medicine'); ?>.
                        </p>
                    </div>
                </div>

                <div class="space-y-5">
                    <div class="rounded-md bg-white border border-slate-200 p-5 shadow-sm">
                        <h3 class="text-base font-heading font-extrabold text-slate-900 mb-4">Availability</h3>
                        <div class="flex flex-wrap gap-2">
                            <?php if (count($daysList)): ?>
                                <?php foreach ($daysList as $day): ?>
                                    <span
                                        class="px-3 py-1.5 rounded-md bg-slate-50 text-slate-700 border border-slate-200 text-xs font-bold shadow-sm">
                                        <?php echo htmlspecialchars(trim($day)); ?>
                                    </span>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-sm text-slate-500">Availability not specified.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="rounded-md bg-teal-900 text-white p-5 shadow-sm border border-teal-800">
                        <h3 class="text-base font-heading font-extrabold mb-2">Book this doctor</h3>
                        <p class="text-teal-100 text-xs mb-4">Proceed to appointment booking with this doctor already
                            selected.</p>
                        <a href="<?php echo htmlspecialchars($LARAVEL_BOOKING_URL); ?>/?slug=<?php echo urlencode($doctor['slug']); ?>"
                            class="flex w-full items-center justify-center bg-white text-teal-900 hover:bg-slate-50 px-4 py-3 rounded-md font-bold transition-colors">
                            Continue Booking
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>