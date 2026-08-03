<?php
// router.php for php -S localhost:8000
if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js|ico|woff|woff2|ttf|svg)$/', $_SERVER["REQUEST_URI"])) {
    return false; // serve the requested resource as-is.
}

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

if ($path === '/sitemap.xml') {
    include 'sitemap.php';
    return;
}

if (preg_match('/^\/best-([a-zA-Z0-9-]+)-in-purnea\/?$/', $path, $matches)) {
    $_GET['slug'] = $matches[1];
    include 'seo-landing.php';
    return;
}

if ($path === '/') {
    include 'index.php';
    return;
}

if (preg_match('/^\/api\/appointment\/slots$/', $path)) {
    include __DIR__ . '/api/get_slots.php';
    return;
}

if (preg_match('/^\/api\/appointment\/book$/', $path)) {
    include __DIR__ . '/api/book_appointment.php';
    return;
}

// Emulate: RewriteCond %{REQUEST_FILENAME}.php -f -> RewriteRule ^(.*)$ $1.php
if (!file_exists(__DIR__ . $path) && file_exists(__DIR__ . $path . '.php')) {
    include __DIR__ . $path . '.php';
    return;
}

if (file_exists(__DIR__ . $path)) {
    return false;
}

// 404
http_response_code(404);
echo "404 Not Found";
