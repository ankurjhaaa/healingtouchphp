<?php
// config/db.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Load .env variables
$envPath = __DIR__ . '/../.env';
if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value, " \t\n\r\0\x0B\"'");
            
            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
}

$host = $_ENV['DB_HOST'] ?? '127.0.0.1';
$dbname = $_ENV['DB_NAME'] ?? $_ENV['DB_DATABASE'] ?? 'healingtouch';
$username = $_ENV['DB_USER'] ?? $_ENV['DB_USERNAME'] ?? 'ankurjha';
$password = $_ENV['DB_PASS'] ?? $_ENV['DB_PASSWORD'] ?? 'Ankur@1234';

// Laravel Application URL for Booking
$LARAVEL_BOOKING_URL = $_ENV['LARAVEL_BOOKING_URL'] ?? 'https://app.healingtouchpurnea.com';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Database Connection failed: " . $e->getMessage());
}
?>
