<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$username = $_SESSION['username'];

// Get numeric user ID
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$user_id = (int)$user['id'];

// Fetch subjects where the user is enrolled
$sql = "
    SELECT DISTINCT c.id, c.course_code, c.course_name, c.facilitator_name
    FROM enrollments e
    JOIN courses c ON e.subject_id = c.id
    WHERE e.user_id = ?
    ORDER BY c.course_code
";
$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);
$subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>My Subjects - Smart Campus Hub</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
@font-face {
    font-family: 'CustomFont';
    src: url('pixelated.ttf') format('truetype');
}

body {
    font-family: 'CustomFont', Arial, sans-serif;
    background: #f1f1f1;
    margin: 0;
}

/* Navbar */
.navbar {
    background: rgba(198, 148, 31, 0.9) !important;
    font-family: 'CustomFont', Arial, sans-serif;
    height: 70px;
}
.navbar-brand {
    display: flex;
    align-items: center;
    gap: 15px;
    font-size: 1.5rem;
}
.navbar-brand img {
    height: 50px;
}

/* Sidebar */
.sidebar {
    width: 220px;
    background: rgba(235, 176, 41, 0.9);
    display: flex;
    flex-direction: column;
    padding: 20px;
    min-height: 100vh;
    overflow-y: auto;
}
.sidebar a {
    color: white;
    margin-bottom: 10px;
    text-decoration: none;
    padding: 8px 10px;
    border-radius: 6px;
}
.sidebar a.text-warning { 
    background: rgba(255, 255, 255, 0.8); 
    font-weight: bold; 
}
.sidebar a:hover { 
    background: rgba(255,165,0,0.9); 
    color: white; 
}
.sidebar .btn-danger { 
    margin-top: auto; 
    width: 100%; 
}

/* Content */
.main-container { display: flex; }
.flex-grow-1 { flex-grow: 1; padding: 20px; }

.card {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    background: #fff;
}

.subject-card {
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 15px;
    background: #fff;
    box-shadow: 0 0 8px rgba(0,0,0,0.05);
}
.subject-card .fw-bold {
    font-size: 1.1rem;
}
.subject-card .prof {
    font-size: 0.9rem;
    color: #555;
    margin-top: 5px;
}
</style>
</head>
<body>

<nav class="navbar sticky-top navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
        <img src="cake.png" alt="Logo">
        <u>Smart Campus Hub</u>
    </a>
  </div>
</nav>

<div class="main-container">
    <div class="sidebar text-white">
        <a href="profile.php" class="d-block mb-3">Profile</a>
        <a href="subjects.php" class="text-warning fw-bold d-block mb-3">Subjects</a>
        <a href="records.php" class="d-block mb-3">Records</a>
        <a href="ecd.php" class="d-block mb-3">ECD</a>
        <a href="about.php" class="d-block mb-3">About</a>
        <a href="index.php" class="btn btn-danger mt-5">Sign Out</a>
    </div>

    <div class="flex-grow-1">
        <h3 class="mb-4 text-center">My Subjects</h3>

        <?php if (empty($subjects)): ?>
            <div class="alert alert-info text-center">You are not enrolled in any subjects.</div>
        <?php else: ?>
            <?php foreach ($subjects as $s): ?>
                <div class="subject-card">
                    <div class="fw-bold">
                        <?= htmlspecialchars($s['course_code']) ?> — <?= htmlspecialchars($s['course_name']) ?>
                    </div>
                    <div class="prof">
                        Professor: <?= htmlspecialchars($s['facilitator_name'] ?? '-') ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
