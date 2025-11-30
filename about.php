<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>About - Smart Campus Hub</title>
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

.main-box {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

h2 {
    font-weight: bold;
    color: #06326b;
    text-align: center;
    margin-bottom: 20px;
}

p {
    font-size: 1rem;
    line-height: 1.6;
    color: #333;
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
        <a href="subjects.php" class="d-block mb-3">Subjects</a>
        <a href="records.php" class="d-block mb-3">Records</a>
        <a href="ecd.php" class="d-block mb-3">ECD</a>
        <a href="about.php" class="text-warning fw-bold d-block mb-3">About</a>
        <a href="index.php" class="btn btn-danger mt-5">Sign Out</a>
    </div>

    <div class="flex-grow-1 p-4">
        <div class="main-box">
            <h2>About Smart Campus Hub</h2>

            <p>
                Smart Campus Hub is a school-driven platform developed to provide students and staff with a
                simple, organized, and accessible system for managing academic information.
            </p>

            <p>
                It brings together essential features into one convenient place, allowing users to access
                what they need quickly and efficiently.
            </p>

            <p>
                This project supports smoother campus operations, reduces manual paperwork, and offers a
                modern approach to handling student records, subjects, and personal information.
            </p>

            <p>
                Thank you for using Smart Campus Hub — designed to enhance school efficiency and make
                campus life easier.
            </p>
        </div>
    </div>
</div>

</body>
</html>
