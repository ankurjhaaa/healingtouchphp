<?php
require_once __DIR__ . '/config/db.php';

$seo_title = 'Our Doctors | Healing Touch Hospital';
$seo_description = 'Browse specialists and quickly book consultations with trusted professionals at Healing Touch Hospital.';
$active_page = 'doctors';

$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = 9;
$offset = ($page - 1) * $limit;

$dept_filter = isset($_GET['dept']) ? $_GET['dept'] : 'all';
$search_term = isset($_GET['search']) ? trim($_GET['search']) : '';

$where_clauses = ["(d.status = 1 OR d.status = '1')"];
$params = [];

if ($dept_filter !== 'all') {
    $where_clauses[] = "dep.name = ?";
    $params[] = $dept_filter;
}

if (!empty($search_term)) {
    $where_clauses[] = "(u.name LIKE ? OR d.qualification LIKE ?)";
    $params[] = "%$search_term%";
    $params[] = "%$search_term%";
}

$where_sql = implode(' AND ', $where_clauses);

$total_pages = 1;
$doctors = [];
$departments = [];

try {
    $count_stmt = $pdo->prepare("SELECT COUNT(u.id) FROM users u INNER JOIN doctors d ON u.id = d.user_id LEFT JOIN departments dep ON d.department_id = dep.id WHERE $where_sql");
    $count_stmt->execute($params);
    $total_doctors = $count_stmt->fetchColumn();
    $total_pages = max(1, ceil($total_doctors / $limit));

    $sql = "SELECT u.id, u.name, d.image, d.qualification, d.available_days, d.slug, dep.name as department_name FROM users u INNER JOIN doctors d ON u.id = d.user_id LEFT JOIN departments dep ON d.department_id = dep.id WHERE $where_sql LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $doctors = $stmt->fetchAll();

    $dept_stmt = $pdo->query("SELECT DISTINCT dep.name FROM departments dep INNER JOIN doctors d ON dep.id = d.department_id WHERE (d.status = 1 OR d.status = '1') AND dep.name IS NOT NULL");
    $departments = $dept_stmt->fetchAll(PDO::FETCH_COLUMN);
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
            <form method="GET" action="/our-doctors" id="filter-form">
                <input type="hidden" name="dept" id="dept-input" value="<?php echo htmlspecialchars($dept_filter); ?>">
                
                <div class="relative w-full mb-3 flex gap-2">
                    <div class="relative flex-grow">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </div>
                        <input
                            type="text"
                            name="search"
                            value="<?php echo htmlspecialchars($search_term); ?>"
                            placeholder="Search by name, specialty..."
                            class="pl-9 w-full px-4 py-3 bg-white shadow-sm rounded-md focus:ring-2 focus:ring-teal-500 focus:outline-none text-sm placeholder-slate-400 border border-slate-200"
                        />
                    </div>
                    <button type="submit" class="bg-teal-700 hover:bg-teal-800 text-white px-4 py-2 rounded-md font-bold text-sm shadow-sm shrink-0">Search</button>
                </div>

                <div class="flex gap-2 overflow-x-auto snap-x snap-mandatory no-scrollbar pb-1">
                    <button type="button" onclick="setDept('all')" class="snap-start shrink-0 rounded-md px-4 py-2 text-xs font-bold transition-colors shadow-sm <?php echo $dept_filter === 'all' ? 'bg-teal-700 text-white' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'; ?>">
                        All
                    </button>
                    <?php foreach($departments as $dept): ?>
                    <button type="button" onclick="setDept('<?php echo htmlspecialchars($dept); ?>')" class="snap-start shrink-0 rounded-md px-4 py-2 text-xs font-bold transition-colors shadow-sm <?php echo $dept_filter === $dept ? 'bg-teal-700 text-white' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'; ?>">
                        <?php echo htmlspecialchars($dept); ?>
                    </button>
                    <?php endforeach; ?>
                </div>
            </form>
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
                        <a href="/doctor-details?slug=<?php echo urlencode($doctor['slug']); ?>" class="flex-1 py-3 text-center text-[11px] font-bold text-slate-700 hover:text-teal-700 transition-colors border-r border-slate-200">Profile</a>
                        <a href="<?php echo htmlspecialchars($LARAVEL_BOOKING_URL ?? '#'); ?>/?slug=<?php echo urlencode($doctor['slug']); ?>" class="flex-1 py-3 text-center text-[11px] font-bold text-teal-700 hover:text-teal-800 transition-colors">Book Now</a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full py-12 text-center text-slate-500 bg-white rounded-md shadow-sm border border-slate-200">
                    <p class="text-sm font-medium">No doctors found.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if($total_pages > 1): ?>
        <div class="flex justify-center items-center gap-2 mt-8 mb-4">
            <?php 
                $qs = $_GET; 
                if($page > 1): 
                    $qs['page'] = $page - 1;
            ?>
                <a href="/our-doctors?<?php echo http_build_query($qs); ?>" class="px-3 py-2 bg-white border border-slate-200 text-slate-600 rounded-md hover:bg-slate-50 text-sm font-bold shadow-sm">Prev</a>
            <?php endif; ?>
            
            <?php for($i = max(1, $page - 2); $i <= min($total_pages, $page + 2); $i++): 
                $qs['page'] = $i;
            ?>
                <a href="/our-doctors?<?php echo http_build_query($qs); ?>" class="w-10 h-10 flex items-center justify-center rounded-md text-sm font-bold shadow-sm <?php echo $i === $page ? 'bg-teal-700 text-white border border-teal-700' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50'; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
            
            <?php if($page < $total_pages): 
                $qs['page'] = $page + 1;
            ?>
                <a href="/our-doctors?<?php echo http_build_query($qs); ?>" class="px-3 py-2 bg-white border border-slate-200 text-slate-600 rounded-md hover:bg-slate-50 text-sm font-bold shadow-sm">Next</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
    function setDept(dept) {
        document.getElementById('dept-input').value = dept;
        // Reset page to 1 on filter change
        const form = document.getElementById('filter-form');
        const url = new URL(form.action);
        url.searchParams.set('dept', dept);
        const search = document.querySelector('input[name="search"]').value;
        if(search) url.searchParams.set('search', search);
        window.location.href = url.toString();
    }
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
