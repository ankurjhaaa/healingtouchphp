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

<!-- App Body Layout -->
<div class="bg-slate-50 min-h-screen pb-6 flex flex-col">
    <!-- Top Spacing -->
    <div class="h-4 lg:h-6"></div>

    <div class="container mx-auto px-4 max-w-7xl flex flex-col gap-4 lg:gap-6 flex-grow">
        
        <!-- Sticky Filters & Search -->
        <div class="sticky top-[60px] lg:top-[70px] z-20 bg-slate-50/95 backdrop-blur-md py-2 -mx-4 px-4 sm:mx-0 sm:px-0">
            <div class="relative w-full mb-3">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </div>
                <input
                    type="text"
                    id="search-doctor"
                    placeholder="Search by name, specialty..."
                    class="pl-9 w-full px-4 py-3 bg-white shadow-sm rounded-md focus:ring-2 focus:ring-teal-500 focus:outline-none text-sm placeholder-slate-400 border border-slate-200"
                />
            </div>

            <div class="flex gap-2 overflow-x-auto snap-x snap-mandatory no-scrollbar pb-1" id="department-filters">
                <button type="button" class="filter-btn snap-start shrink-0 rounded-md px-4 py-2 text-xs font-bold transition-colors bg-teal-700 text-white shadow-sm" data-dept="all">
                    All
                </button>
                <?php foreach($departments as $dept): ?>
                <button type="button" class="filter-btn snap-start shrink-0 rounded-md px-4 py-2 text-xs font-bold transition-colors bg-white text-slate-600 hover:bg-slate-100 shadow-sm border border-slate-200" data-dept="<?php echo htmlspecialchars($dept); ?>">
                    <?php echo htmlspecialchars($dept); ?>
                </button>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Doctors Grid (App Cards) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4" id="doctors-container">
            <?php if(count($doctors) > 0): ?>
                <?php foreach($doctors as $doctor): ?>
                <div class="doctor-card bg-white rounded-md shadow-sm border border-slate-200 flex flex-col hover:shadow-md transition-shadow overflow-hidden"
                   data-name="<?php echo strtolower(htmlspecialchars($doctor['name'])); ?>"
                   data-dept="<?php echo strtolower(htmlspecialchars($doctor['department_name'] ?? '')); ?>"
                   data-qual="<?php echo strtolower(htmlspecialchars(is_string($doctor['qualification']) ? str_replace('"', '', trim($doctor['qualification'], '[]')) : '')); ?>">
                    
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
                        <a href="/doctor-details.php?slug=<?php echo urlencode($doctor['slug']); ?>" class="flex-1 py-3 text-center text-[11px] font-bold text-slate-700 active:bg-slate-200 transition-colors border-r border-slate-200">Profile</a>
                        <a href="<?php echo htmlspecialchars($LARAVEL_BOOKING_URL ?? '#'); ?>/?slug=<?php echo urlencode($doctor['slug']); ?>" class="flex-1 py-3 text-center text-[11px] font-bold text-teal-700 active:bg-teal-100 transition-colors">Book Now</a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full py-12 text-center text-slate-500 bg-white rounded-md shadow-sm border border-slate-200">
                    <p class="text-sm font-medium">No doctors found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.filter-btn');
        const cards = document.querySelectorAll('.doctor-card');
        const searchInput = document.getElementById('search-doctor');
        let activeDept = 'all';

        function filterDoctors() {
            const searchTerm = searchInput.value.toLowerCase();
            let visibleCount = 0;

            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                const dept = card.getAttribute('data-dept');
                const qual = card.getAttribute('data-qual');
                
                const matchesSearch = name.includes(searchTerm) || dept.includes(searchTerm) || qual.includes(searchTerm);
                const matchesDept = (activeDept === 'all' || dept === activeDept.toLowerCase());
                
                if (matchesSearch && matchesDept) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Handle empty state
            let noDocsMsg = document.getElementById('no-doctors-msg');
            if(visibleCount === 0) {
                if(!noDocsMsg) {
                    const msg = document.createElement('div');
                    msg.id = 'no-doctors-msg';
                    msg.className = 'col-span-full py-12 text-center text-slate-500 bg-white rounded-md shadow-sm border border-slate-200 w-full text-sm font-medium';
                    msg.innerText = 'No doctors found.';
                    document.getElementById('doctors-container').appendChild(msg);
                }
            } else {
                if(noDocsMsg) noDocsMsg.remove();
            }
        }

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                // Reset all
                buttons.forEach(b => {
                    b.className = 'filter-btn snap-start shrink-0 rounded-md px-4 py-2 text-xs font-bold transition-colors bg-white text-slate-600 hover:bg-slate-100 shadow-sm border border-slate-200';
                });
                // Active class
                btn.className = 'filter-btn snap-start shrink-0 rounded-md px-4 py-2 text-xs font-bold transition-colors bg-teal-700 text-white shadow-sm border border-transparent';
                
                activeDept = btn.getAttribute('data-dept');
                filterDoctors();
            });
        });

        if (searchInput) {
            searchInput.addEventListener('input', filterDoctors);
        }
    });
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
