<?php
require_once __DIR__ . '/../../config/db.php';
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

if (empty($input['doctor_slug']) || empty($input['date']) || empty($input['time']) || empty($input['name']) || empty($input['phone'])) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields.']);
    exit;
}

try {
    $pdo->beginTransaction();

    // 1. Get doctor
    $stmt = $pdo->prepare("SELECT id FROM doctors WHERE slug = ?");
    $stmt->execute([$input['doctor_slug']]);
    $doctor = $stmt->fetch();
    
    if (!$doctor) {
        $pdo->rollBack();
        echo json_encode(['success' => false, 'message' => 'Doctor not found.']);
        exit;
    }

    // 2. Find or Create Patient
    $stmt = $pdo->prepare("SELECT id FROM patients WHERE phone = ? LIMIT 1");
    $stmt->execute([$input['phone']]);
    $patient = $stmt->fetch();
    
    $patient_id = null;
    if ($patient) {
        $patient_id = $patient['id'];
        // Update patient info
        $updateStmt = $pdo->prepare("UPDATE patients SET name = ?, age = ?, gender = ?, address = ?, pincode = ?, city = ?, state = ?, updated_at = NOW() WHERE id = ?");
        $updateStmt->execute([
            $input['name'], $input['age'], $input['gender'], 
            $input['address'], $input['pincode'], $input['city'], $input['state'],
            $patient_id
        ]);
    } else {
        // Insert new patient
        $insertStmt = $pdo->prepare("INSERT INTO patients (name, phone, age, gender, address, pincode, city, state, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
        $insertStmt->execute([
            $input['name'], $input['phone'], $input['age'], $input['gender'], 
            $input['address'], $input['pincode'], $input['city'], $input['state']
        ]);
        $patient_id = $pdo->lastInsertId();
    }

    // 3. Format Time
    // Convert '10:00 AM' to '10:00:00'
    $time_str = $input['time'];
    $appointment_time = date('H:i:s', strtotime($time_str));
    $appointment_date = $input['date'];

    // Generate appointment number
    $appointment_no = rand(100000, 999999);

    // 4. Insert Appointment
    $apptStmt = $pdo->prepare("INSERT INTO appointments (patient_id, doctor_id, appointment_no, appointment_date, appointment_time, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, 'pending', NOW(), NOW())");
    $apptStmt->execute([
        $patient_id,
        $doctor['id'],
        $appointment_no,
        $appointment_date,
        $appointment_time
    ]);

    $pdo->commit();

    echo json_encode([
        'success' => true,
        'appointment' => [
            'appointment_no' => $appointment_no
        ],
        'receipt_url' => '#' // Add receipt logic if needed
    ]);
} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
