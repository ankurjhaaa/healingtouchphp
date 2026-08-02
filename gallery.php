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

<div class="public-page min-h-screen bg-gray-50 font-sans text-gray-900 antialiased overflow-x-hidden pb-16 lg:pb-0 flex flex-col">
    <main class="max-w-7xl mx-auto w-full px-4 pt-24 sm:pt-28 pb-10">
        <div class="text-left">
            <h1 class="text-3xl font-bold text-gray-900">Hospital Gallery</h1>
            <p class="text-gray-600 mt-2">Facilities and moments from our care center.</p>
        </div>

        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
            <?php if(count($images) > 0): ?>
                <?php foreach($images as $image): ?>
                <div class="bg-white rounded-md border border-gray-200 p-2">
                    <img src="<?php echo htmlspecialchars($image['url'] ?? $image['image'] ?? '/assets/images/default.jpg'); ?>" alt="<?php echo htmlspecialchars($image['alt'] ?? $image['title'] ?? 'Gallery image'); ?>" class="w-full h-52 object-cover rounded-md" />
                    <?php if(!empty($image['title']) || !empty($image['alt'])): ?>
                        <p class="text-sm text-gray-700 mt-2 px-1 line-clamp-2"><?php echo htmlspecialchars($image['title'] ?? $image['alt']); ?></p>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full bg-white rounded-md border border-gray-200 p-6 text-center text-gray-500">No gallery images found.</div>
            <?php endif; ?>
        </div>
    </main>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
