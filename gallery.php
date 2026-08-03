<?php
require_once __DIR__ . '/config/db.php';

$seo_title = 'Gallery - Healing Touch Hospital';
$seo_description = 'Facilities and moments from our care center.';
$active_page = 'gallery';

// Fetch Images
$images = [];
try {
    // Assuming a table named galleries exists
    $stmt = $pdo->prepare("SELECT * FROM galleries ORDER BY id DESC");
    $stmt->execute();
    $images = $stmt->fetchAll();
} catch (Exception $e) {
    // If the table doesn't exist or query fails, images will be empty array
}

include __DIR__ . '/includes/header.php';
?>

<!-- App Body Layout -->
<div class="bg-slate-50 min-h-screen pb-6 flex flex-col">
    <!-- Top Spacing -->
    <div class="h-4 lg:h-6"></div>

    <div class="container mx-auto px-4 max-w-7xl flex flex-col gap-4 lg:gap-6 flex-grow">
        
        <!-- App Header Banner -->
        <section class="bg-white rounded-md p-6 relative overflow-hidden shadow-sm flex flex-col justify-center min-h-[120px] shrink-0 border border-slate-200">
            <div class="relative z-10 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-2 py-1 bg-teal-50 text-teal-700 rounded-md text-[10px] font-bold uppercase mb-2 border border-teal-100">
                    Our Facilities
                </div>
                <h1 class="font-heading text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mb-1">Hospital Gallery</h1>
                <p class="text-slate-500 text-xs sm:text-sm">Moments from our care center.</p>
            </div>
        </section>

        <!-- Gallery Grid -->
        <section class="bg-transparent">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php if(count($images) > 0): ?>
                    <?php foreach($images as $image): ?>
                    <div class="bg-white rounded-md shadow-sm p-3 hover:shadow-md transition-shadow group flex flex-col border border-slate-200">
                        <div class="w-full aspect-[4/3] bg-slate-100 rounded-md overflow-hidden relative border border-slate-200">
                            <img src="<?php echo htmlspecialchars($image['url'] ?? $image['image'] ?? '/assets/images/default.jpg'); ?>" alt="<?php echo htmlspecialchars($image['alt'] ?? $image['title'] ?? 'Gallery image'); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        </div>
                        <?php if(!empty($image['title']) || !empty($image['alt'])): ?>
                            <div class="pt-3 px-2 flex-grow">
                                <p class="text-xs font-bold text-slate-700 line-clamp-2 leading-tight"><?php echo htmlspecialchars($image['title'] ?? $image['alt']); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-full bg-white rounded-md p-12 text-center text-slate-500 shadow-sm flex flex-col items-center justify-center min-h-[200px] border border-slate-200">
                        <div class="w-16 h-16 rounded-md bg-slate-50 border border-slate-200 flex items-center justify-center mb-4">
                            <svg class="h-8 w-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <p class="text-sm font-medium">No gallery images found.</p>
                    </div>
                <?php endif; ?>
            </div>
        </section>

    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
