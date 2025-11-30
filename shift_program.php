<?php
session_start();
include 'db.php';

// Check if logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$username = $_SESSION['username'];

// Get user info + current program
$stmt = $conn->prepare("
    SELECT u.id, u.program_id, p.program_name
    FROM users u
    LEFT JOIN programs p ON u.program_id = p.id
    WHERE u.username = ?
");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$user_id = $user['id'];
$current_program_id = $user['program_id'];
$current_program = $user['program_name'];

// Get all programs EXCEPT the current one
$stmt2 = $conn->prepare("SELECT id, program_name FROM programs WHERE id != ?");
$stmt2->execute([$current_program_id]);
$programs = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shift Program</title>
</head>
<body>

<h2>Program Shifting Request</h2>

<form action="save_record.php" method="POST">

    <!-- Record type for shifting -->
    <input type="hidden" name="record_type_id" value="1">

    <label>Current Program:</label>
    <input type="text" value="<?= htmlspecialchars($current_program) ?>" readonly><br><br>

    <label>New Program:</label>
    <select name="new_program_id" required>
        <option value="">-- Select New Program --</option>
        <?php foreach ($programs as $p): ?>
            <option value="<?= $p['id'] ?>">
                <?= htmlspecialchars($p['program_name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <br><br>
    <button type="submit">Submit Request</button>

</form>

</body>
</html>
