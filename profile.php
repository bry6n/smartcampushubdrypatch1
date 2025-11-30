<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$username = $_SESSION['username'];

// Handle profile picture upload
if(isset($_FILES['profile_pic'])){
    $file = $_FILES['profile_pic'];
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $allowed = ['jpg','jpeg','png','gif'];

    if(in_array(strtolower($ext), $allowed)){
        $newName = $username.'_'.time().'.'.$ext;
        $destination = 'uploads/'.$newName;

        if(move_uploaded_file($file['tmp_name'], $destination)){
            $stmt = $conn->prepare("UPDATE users SET profile_pic = ? WHERE username = ?");
            $stmt->execute([$destination, $username]);
            header("Location: profile.php");
            exit;
        } else {
            $upload_error = "Failed to upload file.";
        }
    } else {
        $upload_error = "Invalid file type. Only JPG, PNG, GIF allowed.";
    }
}

// Fetch user info
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Get current program
$programStmt = $conn->prepare("SELECT program_name FROM programs WHERE id = ?");
$programStmt->execute([$user['current_program_id']]);
$program = $programStmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Profile - Smart Campus Hub</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<style>
/* TFF Font */
@font-face {
    font-family: 'CustomFont';
    src: url('pixelated.ttf') format('truetype');
}

body {
    font-family: 'CustomFont', Arial, sans-serif;
    background: #f1f1f1;
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
.card { max-width: 600px; margin: auto; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); background: #fff; }

/* Profile picture hover */
.profile-container {
    position: relative;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    overflow: hidden;
    cursor: pointer;
    margin: 0 auto;
}
.profile-pic { 
    width: 100%; height: 100%; object-fit: cover; 
    border: 3px solid rgba(198,148,31,0.9); border-radius: 50%;
    transition: transform 0.3s ease;
}
.profile-container:hover .profile-pic { transform: scale(1.05); }

.overlay {
    position: absolute; top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.5); border-radius: 50%;
    color: white; display: flex; align-items: center; justify-content: center;
    font-size: 2rem; opacity: 0; transition: opacity 0.3s ease, transform 0.3s ease;
    transform: scale(0.9);
}
.profile-container:hover .overlay { opacity: 1; transform: scale(1); }

input[type="file"] { display: none; }
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
        <a href="profile.php" class="text-warning fw-bold d-block mb-3">Profile</a>
        <a href="subjects.php" class="d-block mb-3">Subjects</a>
        <a href="records.php" class="d-block mb-3">Records</a>
        <a href="ecd.php" class="d-block mb-3">ECD</a>
        <a href="about.php" class="d-block mb-3">About</a>
        <a href="index.php" class="btn btn-danger mt-5">Sign Out</a>
    </div>

    <div class="flex-grow-1">
        <h3 class="mb-4 text-center">Profile</h3>

        <div class="card text-center">
            <!-- Hover-to-change Profile Picture -->
            <div class="profile-container mb-3">
                <img id="preview" src="<?= htmlspecialchars($user['profile_pic'] ?? 'default.png') ?>" 
                     alt="Profile Picture" class="profile-pic">
                <div class="overlay"><i class="bi bi-camera"></i></div>
                <form id="uploadForm" method="POST" enctype="multipart/form-data">
                    <input type="file" name="profile_pic" id="profilePicInput" accept="image/*">
                </form>
            </div>

            <?php if(isset($upload_error)): ?>
                <p class="text-danger mt-2"><?= htmlspecialchars($upload_error) ?></p>
            <?php endif; ?>

            <div class="row mb-3">
                <div class="col-md-3 fw-bold text-start">Student Number:</div>
                <div class="col-md-9 text-start"><?= htmlspecialchars($user['username']); ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold text-start">First Name:</div>
                <div class="col-md-9 text-start"><?= htmlspecialchars($user['first_name']); ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold text-start">Last Name:</div>
                <div class="col-md-9 text-start"><?= htmlspecialchars($user['last_name']); ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold text-start">Email:</div>
                <div class="col-md-9 text-start"><?= htmlspecialchars($user['email']); ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold text-start">Program:</div>
                <div class="col-md-9 text-start"><?= htmlspecialchars($program['program_name'] ?? 'No Program') ?></div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const input = document.getElementById('profilePicInput');
const preview = document.getElementById('preview');
const form = document.getElementById('uploadForm');
const overlay = document.querySelector('.overlay');

preview.addEventListener('click', () => input.click());
overlay.addEventListener('click', () => input.click());

input.addEventListener('change', function() {
    const file = this.files[0];
    if(file){
        const reader = new FileReader();
        reader.onload = function(e){
            preview.src = e.target.result;
        }
        reader.readAsDataURL(file);
        form.submit();
    }
});
</script>

</body>
</html>
