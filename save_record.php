<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$username = $_SESSION['username'];

// Get user info
$stmt = $conn->prepare("SELECT id, program_id FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$user_id = $user['id'];
$current_program_id = $user['program_id'];

// Get POST data
$record_type_id = $_POST['record_type_id'] ?? null;
$new_program_id = $_POST['new_program_id'] ?? null;

// Prevent duplicate pending requests for same type
$checkStmt = $conn->prepare("SELECT * FROM record_requests WHERE user_id = ? AND record_type_id = ? AND status='Pending'");
$checkStmt->execute([$user_id, $record_type_id]);
$existing = $checkStmt->fetch(PDO::FETCH_ASSOC);

if ($existing) {
    header("Location: records.php?pending=1");
    exit;
}

// Insert new request
$insertStmt = $conn->prepare("
    INSERT INTO record_requests (user_id, record_type_id, current_program_id, new_program_id, status, date_requested)
    VALUES (?, ?, ?, ?, 'Pending', NOW())
");

// If it's not a shifting request, set new_program_id as NULL
$new_program_value = ($record_type_id == 1 && !empty($new_program_id)) ? $new_program_id : null;

$insertStmt->execute([$user_id, $record_type_id, $current_program_id, $new_program_value]);

header("Location: records.php?success=1");
exit;
