<?php
require_once __DIR__ . '/config/db.php';

$seo_title = 'Our Doctors | Healing Touch Hospital';
$seo_description = 'Browse specialists and quickly book consultations with trusted professionals at Healing Touch Hospital.';
$active_page = 'doctors';

// Fetch Doctors and Departments
$doctors = [];
$departments = [];
try {
    $stmt = $pdo->prepare("
        SELECT u.id, u.name, d.image, d.qualification, d.available_days, d.slug, dep.name as department_name 
        FROM users u 
        INNER JOIN doctors d ON u.id = d.user_id 
        LEFT JOIN departments dep ON d.department_id = dep.id 
        WHERE (d.status = 1 OR d.status = '1')
    ");
    $stmt->execute();
    $doctors = $stmt->fetchAll();

    foreach($doctors as $doc) {
        if(!empty($doc['department_name']) && !in_array($doc['department_name'], $departments)) {
            $departments[] = $doc['department_name'];
        }
    }
} catch (Exception $e) {}

include __DIR__ . '/includes/header.php';
?>

<div class="public-page min-h-screen bg-gray-50 font-sans text-gray-900 antialiased overflow-x-hidden pb-16 lg:pb-0 flex flex-col">
    <main class="flex-1 w-full pt-24 sm:pt-28 pb-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-6 sm:mb-8">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 tracking-tight">Meet Our Expert Doctors</h1>
                <p class="mt-2 text-sm sm:text-base md:text-lg text-gray-600 max-w-2xl mx-auto">Browse specialists and quickly book consultations with trusted professionals.</p>
                <div class="mt-3 flex justify-center">
                    <div class="h-1 w-20 bg-beige-600 rounded-full"></div>
                </div>
            </div>

            <div class="sticky top-20 sm:top-24 z-20 mb-6 sm:mb-8">
                <div class="bg-white/95 backdrop-blur rounded-2xl border border-gray-200 shadow-sm p-3 sm:p-4">
                    <div class="relative w-full mb-3">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input
                            type="text"
                            id="search-doctor"
                            placeholder="Search by name, specialty, or expertise..."
                            class="pl-10 w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-beige-500 focus:border-beige-500 focus:outline-none text-sm sm:text-base"
                        />
                    </div>

                    <div class="flex gap-2 overflow-x-auto pb-1 snap-x snap-mandatory [scrollbar-width:none] [&::-webkit-scrollbar]:hidden" id="department-filters">
                        <button type="button" class="filter-btn snap-start shrink-0 rounded-full border px-4 py-2 text-xs sm:text-sm font-semibold transition-colors bg-beige-600 border-beige-600 text-white" data-dept="all">
                            All Departments
                        </button>
                        <?php foreach($departments as $dept): ?>
                        <button type="button" class="filter-btn snap-start shrink-0 rounded-full border px-4 py-2 text-xs sm:text-sm font-semibold transition-colors bg-white border-gray-200 text-gray-700 hover:bg-beige-50 hover:border-beige-200" data-dept="<?php echo htmlspecialchars($dept); ?>">
                            <?php echo htmlspecialchars($dept); ?>
                        </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-8" id="doctors-container">
                <?php if(count($doctors) > 0): ?>
                    <?php foreach($doctors as $doctor): ?>
                    <a href="/doctor-details.php?slug=<?php echo urlencode($doctor['slug']); ?>" 
                       class="doctor-card group bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow h-full flex flex-col"
                       data-name="<?php echo strtolower(htmlspecialchars($doctor['name'])); ?>"
                       data-dept="<?php echo strtolower(htmlspecialchars($doctor['department_name'] ?? '')); ?>"
                       data-qual="<?php echo strtolower(htmlspecialchars(is_string($doctor['qualification']) ? str_replace('"', '', trim($doctor['qualification'], '[]')) : '')); ?>">
                        
                        <div class="p-4 sm:p-5 flex-grow">
                            <div class="flex items-start gap-3 sm:gap-4">
                                <div class="flex-shrink-0">
                                    <img class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl object-cover border border-beige-200" src="<?php echo htmlspecialchars($doctor['image'] ?? '/assets/images/default.jpg'); ?>" alt="Dr. <?php echo htmlspecialchars($doctor['name']); ?>" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-base sm:text-lg font-bold text-gray-800 truncate">Dr. <?php echo htmlspecialchars($doctor['name']); ?></h3>
                                    <p class="text-xs sm:text-sm font-semibold text-beige-600 truncate"><?php echo htmlspecialchars($doctor['department_name'] ?? 'General'); ?></p>
                                    <p class="mt-1 text-xs sm:text-sm font-medium text-gray-600 line-clamp-2">
                                        <?php echo htmlspecialchars(is_string($doctor['qualification']) ? str_replace('"', '', trim($doctor['qualification'], '[]')) : '-'); ?>
                                    </p>
                                    <p class="mt-2 text-xs text-gray-500 line-clamp-1">
                                        Available: <?php echo htmlspecialchars(is_string($doctor['available_days']) ? str_replace('"', '', trim($doctor['available_days'], '[]')) : '-'); ?>
                                    </p>
                                </div>
                            </div>

                            <div class="mt-4 flex items-center text-amber-500">
                                <?php for($i=0; $i<5; $i++): ?>
                                <svg class="w-4 h-4" fill="#906A39" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                <?php endfor; ?>
                            </div>
                        </div>

                        <div class="bg-gray-50 px-4 py-3 border-t border-gray-200 mt-auto">
                            <span class="inline-flex items-center text-sm font-semibold text-beige-700 group-hover:text-beige-800">
                                View Profile
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        </div>
                    </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-full py-16 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-xl font-medium text-gray-900">No doctors found</h3>
                        <p class="mt-1 text-gray-500">Try adjusting your search criteria.</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="sm:hidden fixed bottom-20 right-4 z-40">
                <a href="/contact-us.php" class="inline-flex items-center gap-2 bg-beige-600 hover:bg-beige-700 text-white rounded-full border border-beige-600 py-3 px-4 shadow-lg transition-colors duration-150">
                    <span class="text-base">📞</span>
                    <span class="text-sm font-semibold">Need Help</span>
                </a>
            </div>
        </div>
    </main>
</div>

<script>
    $(document).ready(function() {
        let activeDept = 'all';

        $('.filter-btn').on('click', function() {
            $('.filter-btn').removeClass('bg-beige-600 border-beige-600 text-white').addClass('bg-white border-gray-200 text-gray-700 hover:bg-beige-50 hover:border-beige-200');
            $(this).removeClass('bg-white border-gray-200 text-gray-700 hover:bg-beige-50 hover:border-beige-200').addClass('bg-beige-600 border-beige-600 text-white');
            
            activeDept = $(this).data('dept');
            filterDoctors();
        });

        $('#search-doctor').on('keyup', function() {
            filterDoctors();
        });

        function filterDoctors() {
            const searchTerm = $('#search-doctor').val().toLowerCase();
            let visibleCount = 0;

            $('.doctor-card').each(function() {
                const name = $(this).data('name');
                const dept = $(this).data('dept');
                const qual = $(this).data('qual');
                
                let matchesSearch = (name.indexOf(searchTerm) !== -1 || dept.indexOf(searchTerm) !== -1 || qual.indexOf(searchTerm) !== -1);
                let matchesDept = (activeDept === 'all' || dept === activeDept.toLowerCase());
                
                if (matchesSearch && matchesDept) {
                    $(this).show();
                    visibleCount++;
                } else {
                    $(this).hide();
                }
            });
            
            // Handle empty state
            if(visibleCount === 0) {
                if($('#no-doctors-msg').length === 0) {
                    $('#doctors-container').append(`
                        <div id="no-doctors-msg" class="col-span-full py-16 text-center w-full">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-xl font-medium text-gray-900">No doctors found</h3>
                        </div>
                    `);
                }
            } else {
                $('#no-doctors-msg').remove();
            }
        }
    });
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
