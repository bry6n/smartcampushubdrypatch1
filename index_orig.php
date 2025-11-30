<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Smart Campus Hub</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Your CSS must come AFTER Bootstrap -->
  <link rel="stylesheet" href="style.css">
</head>

<body>

<header class="header-bar d-flex align-items-center px-3 py-2">
  <div class="logo me-2">
    <img src="logo-placeholder.png" width="40" height="40">
  </div>

  <h1 class="flex-grow-1 m-0">Smart Campus Hub</h1>

  <div class="notification position-relative">
    <span class="fs-4">🔔</span>
    <span class="red-dot"></span>
  </div>
</header>

<div class="d-flex main-wrapper">

  <!-- SIDEBAR -->
  <nav class="sidebar p-3">
    <button class="nav-btn active w-100 mb-2">PROFILE</button>
    <button class="nav-btn w-100 mb-2">SUBJECTS</button>
    <button class="nav-btn w-100 mb-2">RECORDS</button>
    <button class="nav-btn w-100 mb-2">ECD</button>
    <button class="nav-btn w-100 mb-2">ABOUT</button>

    <button class="sign-out w-100 mt-auto">SIGN OUT</button>
  </nav>

  <!-- MAIN CONTENT -->
  <main class="flex-grow-1 p-4">

    <div class="row g-4">
      <!-- Profile Pic -->
      <div class="col-lg-4 col-md-5">
        <div class="profile-pic-box">300 × 300</div>
      </div>

      <!-- Profile Info -->
      <div class="col-lg-4 col-md-6">
        <div class="info-box mb-3">
          <strong>Name:</strong> Nixxon Wayne Provido
        </div>

        <div class="info-box mb-3">
          <strong>COURSE:</strong><br>
          <strong>YEAR:</strong>
        </div>

        <div class="info-box about-box">
          <strong>About:</strong>
        </div>
      </div>
    </div>

  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
