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

<div
    class="public-page min-h-screen bg-gray-50 font-sans text-gray-900 antialiased overflow-x-hidden pb-16 lg:pb-0 flex flex-col">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12 w-full">
        <a href="/our-doctors.php"
            class="inline-flex items-center text-sm text-beige-700 font-semibold hover:underline">
            ← Back to Doctors
        </a>

        <div class="mt-4 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="bg-gradient-to-r from-beige-50 to-beige-100 border-b border-beige-100 px-5 sm:px-6 py-5">
                <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                    <img src="<?php echo htmlspecialchars($doctor['image'] ?? '/assets/images/default.jpg'); ?>"
                        alt="<?php echo htmlspecialchars($doctor['name']); ?>"
                        class="w-24 h-24 sm:w-28 sm:h-28 rounded-full object-cover border-4 border-white shadow-md" />

                    <div class="flex-1">
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Dr.
                            <?php echo htmlspecialchars($doctor['name']); ?></h1>
                        <p class="text-beige-700 font-semibold mt-1 text-lg">
                            <?php echo htmlspecialchars($doctor['department_name'] ?? '-'); ?></p>
                        <div class="mt-3 flex flex-wrap gap-2 text-sm">
                            <span
                                class="px-3 py-1 rounded-full bg-white text-gray-700 border border-gray-200">₹<?php echo htmlspecialchars($fee); ?></span>
                            <span
                                class="px-3 py-1 rounded-full bg-white text-gray-700 border border-gray-200"><?php echo htmlspecialchars($qualification); ?></span>
                        </div>
                    </div>

                    <a href="/book-appointment.php?slug=<?php echo urlencode($doctor['slug']); ?>"
                        class="inline-flex items-center justify-center bg-beige-600 hover:bg-beige-700 text-white px-5 py-3 rounded-lg font-semibold shadow-sm self-start sm:self-center">
                        Book Appointment
                    </a>
                </div>
            </div>

            <div class="p-5 sm:p-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-5">
                    <div class="rounded-2xl bg-beige-50/60 border border-beige-100 p-5">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Doctor Information</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-beige-600 border border-beige-100 shrink-0">
                                    🏥</div>
                                <div>
                                    <p class="text-xs uppercase tracking-wider text-gray-500">Department</p>
                                    <p class="font-semibold text-gray-900">
                                        <?php echo htmlspecialchars($doctor['department_name'] ?? '-'); ?></p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-beige-600 border border-beige-100 shrink-0">
                                    🎓</div>
                                <div>
                                    <p class="text-xs uppercase tracking-wider text-gray-500">Qualification</p>
                                    <p class="font-semibold text-gray-900">
                                        <?php echo htmlspecialchars($qualification); ?></p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-beige-600 border border-beige-100 shrink-0">
                                    💰</div>
                                <div>
                                    <p class="text-xs uppercase tracking-wider text-gray-500">Consultation Fee</p>
                                    <p class="font-semibold text-gray-900">₹<?php echo htmlspecialchars($fee); ?></p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-beige-600 border border-beige-100 shrink-0">
                                    📅</div>
                                <div>
                                    <p class="text-xs uppercase tracking-wider text-gray-500">Available Days</p>
                                    <p class="font-semibold text-gray-900">
                                        <?php echo count($daysList) ? htmlspecialchars(implode(', ', $daysList)) : 'Not specified'; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl bg-white border border-gray-100 p-5 shadow-sm">
                        <h2 class="text-lg font-bold text-gray-900 mb-3">About Dr.
                            <?php echo htmlspecialchars($doctor['name']); ?></h2>
                        <p class="text-gray-700 leading-relaxed">
                            Dr. <?php echo htmlspecialchars($doctor['name']); ?> is a highly skilled healthcare
                            professional with comprehensive training and experience in the field of
                            <?php echo htmlspecialchars($doctor['department_name'] ?? 'medicine'); ?>.
                        </p>
                    </div>
                </div>

                <div class="space-y-5">
                    <div class="rounded-2xl bg-white border border-gray-100 p-5 shadow-sm">
                        <h3 class="text-base font-bold text-gray-900 mb-4">Availability</h3>
                        <div class="flex flex-wrap gap-2">
                            <?php if (count($daysList)): ?>
                                <?php foreach ($daysList as $day): ?>
                                    <span
                                        class="px-3 py-1.5 rounded-full bg-beige-50 text-beige-700 border border-beige-100 text-sm font-medium">
                                        <?php echo htmlspecialchars(trim($day)); ?>
                                    </span>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-sm text-gray-500">Availability not specified.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="rounded-2xl bg-beige-600 text-white p-5 shadow-sm">
                        <h3 class="text-base font-bold mb-2">Book this doctor</h3>
                        <p class="text-beige-100 text-sm mb-4">Proceed to appointment booking with this doctor already
                            selected.</p>
                        <a href="/book-appointment.php?slug=<?php echo urlencode($doctor['slug']); ?>"
                            class="inline-flex items-center justify-center bg-white text-beige-700 hover:bg-beige-50 px-4 py-2.5 rounded-lg font-semibold">
                            Continue Booking
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>