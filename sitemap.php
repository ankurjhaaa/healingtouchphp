<?php
require_once __DIR__ . '/config/db.php';

header("Content-Type: application/xml; charset=utf-8");

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$base_url = "$protocol://$host";

$date = date('Y-m-d');

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo "\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";

// Function to add url to sitemap
function add_url($url, $lastmod, $changefreq, $priority) {
    echo "
    <url>
        <loc>" . htmlspecialchars($url) . "</loc>
        <lastmod>" . $lastmod . "</lastmod>
        <changefreq>" . $changefreq . "</changefreq>
        <priority>" . $priority . "</priority>
    </url>";
}

// Static Pages
$static_pages = [
    '/' => '1.0',
    '/services' => '0.9',
    '/our-doctors' => '0.9',
    '/about-us' => '0.8',
    '/gallery' => '0.8',
    '/careers' => '0.7',
    '/contact-us' => '0.8',
    '/privacy-policy' => '0.5',
    '/terms-conditions' => '0.5',
];

foreach ($static_pages as $path => $priority) {
    add_url($base_url . $path, $date, 'weekly', $priority);
}

// Dynamic SEO Landing Pages (Departments)
try {
    $stmt = $pdo->query("SELECT name FROM departments WHERE (status = 1 OR status = '1') AND name IS NOT NULL");
    while ($row = $stmt->fetch()) {
        $slug = strtolower(str_replace(' ', '-', trim($row['name'])));
        add_url($base_url . '/best-' . $slug . '-in-purnea', $date, 'weekly', '0.9');
        add_url($base_url . '/best-' . $slug . '-doctor-in-purnea', $date, 'weekly', '0.9');
    }
} catch (Exception $e) {}

// Generic high-value keywords
add_url($base_url . '/best-hospital-in-purnea', $date, 'weekly', '1.0');
add_url($base_url . '/best-multispeciality-hospital-in-purnea', $date, 'weekly', '1.0');

// Dynamic Doctor Pages
try {
    $stmt = $pdo->query("SELECT slug FROM doctors WHERE (status = 1 OR status = '1') AND slug IS NOT NULL");
    while ($row = $stmt->fetch()) {
        add_url($base_url . '/doctor-details?slug=' . urlencode($row['slug']), $date, 'weekly', '0.8');
    }
} catch (Exception $e) {}

echo "\n</urlset>";
