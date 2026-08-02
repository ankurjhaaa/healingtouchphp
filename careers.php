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

<div class="public-page min-h-screen bg-gray-50 font-sans text-gray-900 antialiased overflow-x-hidden pb-10 flex flex-col">
    <div class="bg-slate-900 mt-16 pt-16 pb-28 px-4 relative overflow-hidden">
        <div class="absolute inset-x-0 bottom-0 top-0 bg-[radial-gradient(ellipse_at_bottom,_var(--tw-gradient-stops))] from-beige-900/20 via-slate-900 to-slate-900"></div>
        <div class="max-w-5xl mx-auto relative z-10 text-center">
            <span class="bg-white/10 text-beige-100 px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest mb-4 inline-block border border-white/10">Join Healing Touch</span>
            <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tight mb-4">Build the future of <br class="hidden sm:block"/>healthcare with us.</h1>
            <p class="text-slate-400 text-sm sm:text-lg max-w-2xl mx-auto mb-2">We are always looking for passionate, skilled individuals to join our mission of delivering exceptional medical care to the society.</p>
        </div>
    </div>

    <main class="max-w-5xl mx-auto w-full px-4 -mt-16 relative z-20 flex-1 pb-16">
        
        <div class="flex items-center justify-between mb-6 px-2">
            <h2 class="text-xl font-black text-gray-900">Open Positions</h2>
            <span class="text-sm font-bold text-gray-500"><?php echo count($careers); ?> job<?php echo count($careers) !== 1 ? 's' : ''; ?> available</span>
        </div>

        <div class="grid gap-4 sm:gap-6">
            <?php if(count($careers) > 0): ?>
                <?php foreach($careers as $career): ?>
                <div class="bg-white rounded-md border border-gray-200 p-5 sm:p-8 shadow-[0_4px_20px_rgb(0,0,0,0.03)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-all group">
                    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-6">
                        <div class="flex-1">
                            <h3 class="text-xl sm:text-2xl font-black text-gray-900 group-hover:text-beige-600 transition-colors"><?php echo htmlspecialchars($career['title']); ?></h3>
                            
                            <div class="flex flex-wrap items-center gap-2 mt-3 mb-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-100 text-gray-700 rounded-md text-xs font-bold font-mono">
                                    <span>📍</span> <?php echo htmlspecialchars($career['location'] ?? 'Purnea'); ?>
                                </span>
                                <?php if(!empty($career['salary'])): ?>
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded-md text-xs font-bold font-mono">
                                        <span>💰</span> <?php echo htmlspecialchars($career['salary']); ?>
                                    </span>
                                <?php endif; ?>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-beige-50 text-beige-700 border border-beige-100 rounded-md text-xs font-bold font-mono">
                                    <span>⏱️</span> Full Time
                                </span>
                            </div>

                            <p class="text-gray-600 text-sm sm:text-base leading-relaxed line-clamp-2 md:line-clamp-3 w-4/5">
                                <?php echo htmlspecialchars($career['description']); ?>
                            </p>
                        </div>
                        
                        <div class="shrink-0 flex items-center justify-start sm:justify-end w-full sm:w-auto border-t sm:border-0 border-gray-100 pt-4 sm:pt-0 mt-2 sm:mt-0">
                            <a 
                                href="/career-details.php?id=<?php echo urlencode($career['id']); ?>" 
                                class="w-full sm:w-auto text-center px-6 py-3 bg-slate-900 hover:bg-black text-white rounded-md text-sm font-black transition-all active:scale-95"
                            >
                                Apply Now
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="bg-white rounded-md border border-gray-200 p-12 text-center shadow-sm">
                    <div class="w-16 h-16 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                    </div>
                    <h3 class="text-xl font-black text-gray-900">No Openings Available</h3>
                    <p class="text-gray-500 mt-2">Currently, there are no open positions. Please check back later or drop your resume at our hospital desk.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
