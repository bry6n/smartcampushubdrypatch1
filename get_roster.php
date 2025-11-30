<?php
session_start();
include 'db.php'; // main DB connection

if (!isset($_GET['course_id'])) {
    echo "No course selected.";
    exit;
}

$course_id = (int)$_GET['course_id'];

// Fetch students enrolled in this subject
$sql = "
    SELECT u.id, u.first_name, u.last_name, u.username
    FROM enrollments e
    JOIN users u ON e.user_id = u.id
    WHERE e.subject_id = ?
    ORDER BY u.last_name, u.first_name
";

$stmt = $conn->prepare($sql);
$stmt->execute([$course_id]);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($students)) {
    echo "<div>No students enrolled in this class.</div>";
    exit;
}

// Display table
echo '<table class="table table-striped">';
echo '<thead><tr><th>ID</th><th>Last Name</th><th>First Name</th><th>Username</th></tr></thead>';
echo '<tbody>';
foreach ($students as $s) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($s['id']) . '</td>';
    echo '<td>' . htmlspecialchars($s['last_name']) . '</td>';
    echo '<td>' . htmlspecialchars($s['first_name']) . '</td>';
    echo '<td>' . htmlspecialchars($s['username']) . '</td>';
    echo '</tr>';
}
echo '</tbody></table>';
?>
