<?php
require_once __DIR__ . '/../../config/db.php';
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$doctor_slug = $input['doctor_slug'] ?? '';
$date = $input['date'] ?? '';

if (empty($doctor_slug) || empty($date)) {
    echo json_encode(['error' => 'Doctor and date are required.']);
    exit;
}

try {
    // Check doctor exists
    $stmt = $pdo->prepare("SELECT id FROM doctors WHERE slug = ?");
    $stmt->execute([$doctor_slug]);
    $doctor = $stmt->fetch();
    
    if (!$doctor) {
        echo json_encode(['error' => 'Doctor not found.']);
        exit;
    }

    // Generate dummy slots
    $slots = [];
    $times = [
        '10:00 AM', '10:30 AM', '11:00 AM', '11:30 AM',
        '12:00 PM', '12:30 PM', '01:00 PM', '02:00 PM',
        '03:00 PM', '04:00 PM', '04:30 PM', '05:00 PM'
    ];
    
    // Randomize availability a bit for demo purposes
    foreach($times as $time) {
        $slots[] = [
            'slot' => $time,
            'booked' => rand(0, 4),
            'bookable' => true // simplified
        ];
    }
    
    echo json_encode(['slots' => $slots, 'message' => '']);
    
} catch (Exception $e) {
    echo json_encode(['error' => 'An error occurred while fetching slots.']);
}
