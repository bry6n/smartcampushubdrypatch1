<?php
session_start();
header('Content-Type: application/json');
include 'db.php';

if (!isset($_SESSION['username'])) {
    echo json_encode(['success'=>false,'message'=>'Not logged in']);
    exit;
}

// Get numeric user ID
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$_SESSION['username']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user) {
    echo json_encode(['success'=>false,'message'=>'User not found']);
    exit;
}
$user_id = (int)$user['id'];

// Get POST data
$professor_name = trim($_POST['professor_name'] ?? '');
$rating = (int)($_POST['rating'] ?? 0);

if ($professor_name === '' || $rating < 1 || $rating > 5) {
    echo json_encode(['success'=>false,'message'=>'Invalid data']);
    exit;
}

// Insert or update rating
try {
    $stmt = $conn->prepare("
        INSERT INTO ratings (user_id, professor_name, rating)
        VALUES (:uid, :prof, :rating)
        ON DUPLICATE KEY UPDATE rating = :rating2, created_at = CURRENT_TIMESTAMP
    ");
    $stmt->execute([
        'uid' => $user_id,
        'prof' => $professor_name,
        'rating' => $rating,
        'rating2' => $rating
    ]);
    echo json_encode(['success'=>true]);
} catch (Exception $e) {
    echo json_encode(['success'=>false,'message'=>$e->getMessage()]);
}
