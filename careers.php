<?php
require_once __DIR__ . '/config/db.php';

$seo_title = 'Careers - Healing Touch Hospital';
$seo_description = 'Build the future of healthcare with us. Explore career opportunities at Healing Touch Hospital.';
$active_page = 'careers';

// Fetch Careers
$careers = [];
try {
    // We assume a careers table exists based on typical structure.
    $stmt = $pdo->prepare("SELECT * FROM careers WHERE status = 1 OR status = '1' ORDER BY id DESC");
    $stmt->execute();
    $careers = $stmt->fetchAll();
} catch (Exception $e) {
    // If the table doesn't exist or query fails, careers will be empty array
}

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
                    Join Our Team
                </div>
                <h1 class="font-heading text-2xl sm:text-3xl font-extrabold text-white mb-1 tracking-tight">Careers</h1>
                <p class="text-slate-400 text-xs sm:text-sm">Build the future of healthcare with us.</p>
            </div>
        </section>

        <!-- Openings -->
        <section>
            <div class="flex items-center justify-between mb-3 px-1">
                <h2 class="text-lg font-heading font-extrabold text-slate-900">Open Positions</h2>
                <span class="text-[10px] font-bold text-slate-500 bg-white shadow-sm px-2 py-1 rounded-md border border-slate-200"><?php echo count($careers); ?> Jobs</span>
            </div>

            <div class="grid gap-3">
                <?php if(count($careers) > 0): ?>
                    <?php foreach($careers as $career): ?>
                    <div class="bg-white rounded-md p-4 shadow-sm hover:shadow-md transition-shadow flex flex-col sm:flex-row gap-4 justify-between items-start border border-slate-200">
                        <div class="flex-1">
                            <h3 class="text-base font-heading font-extrabold text-slate-900 hover:text-teal-700 transition-colors mb-1"><?php echo htmlspecialchars($career['title']); ?></h3>
                            
                            <div class="flex flex-wrap items-center gap-2 mb-3">
                                <span class="inline-flex items-center gap-1 px-2 py-1 bg-slate-50 text-slate-600 rounded-md text-[10px] font-bold uppercase border border-slate-200">
                                    <svg class="w-3 h-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <?php echo htmlspecialchars($career['location'] ?? 'Purnea'); ?>
                                </span>
                                <?php if(!empty($career['salary'])): ?>
                                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-teal-50 text-teal-700 rounded-md text-[10px] font-bold uppercase border border-teal-100">
                                        <svg class="w-3 h-3 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <?php echo htmlspecialchars($career['salary']); ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <p class="text-slate-500 text-[11px] sm:text-xs leading-relaxed line-clamp-2">
                                <?php echo htmlspecialchars($career['description']); ?>
                            </p>
                        </div>
                        
                        <div class="shrink-0 w-full sm:w-auto mt-2 sm:mt-0">
                            <a 
                                href="/career-details.php?id=<?php echo urlencode($career['id']); ?>" 
                                class="flex items-center justify-center w-full sm:w-auto px-5 py-2.5 bg-slate-50 text-teal-700 hover:bg-teal-50 hover:text-teal-800 border border-slate-200 hover:border-teal-200 active:bg-teal-100 rounded-md text-xs font-bold transition-colors"
                            >
                                Apply Now
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="bg-white rounded-md p-10 text-center shadow-sm flex flex-col items-center justify-center border border-slate-200">
                        <div class="w-16 h-16 rounded-md bg-slate-50 border border-slate-200 flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        </div>
                        <h3 class="text-sm font-heading font-extrabold text-slate-900">No Openings Available</h3>
                        <p class="text-[11px] text-slate-500 mt-1 max-w-xs mx-auto">Check back later or drop your resume at our hospital desk.</p>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
