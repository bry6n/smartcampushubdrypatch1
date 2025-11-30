<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<link rel="stylesheet" href="styledashboard.css">
<link rel="shortcut icon" type="image/png" href="cake.png">
</head>
<body>

<div class="dashboard-container">
    <h1>Welcome, <?php echo $_SESSION['first_name']; ?>!</h1>
    <p>Your Student Number: <strong><?php echo $_SESSION['username']; ?></strong></p>

    <div class="dashboard-actions">
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>S
</div>

</body>
</html>
