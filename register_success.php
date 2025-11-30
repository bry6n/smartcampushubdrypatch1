<?php
session_start();
if(!isset($_SESSION['student_number'], $_SESSION['first_name'])){
    header("Location: register.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Successful</title>
<link rel="stylesheet" href="styleconfirm.css">
<link rel="shortcut icon" type="image/png" href="cake.png">
</head>
<body>
<div class="container">
    <div class="message-box">
        <h1>Welcome, <?php echo $_SESSION['first_name']; ?>!</h1>
        <p>Your Student Number is:</p>
        <h2><?php echo $_SESSION['student_number']; ?></h2>
        <p>Please use this student number to <a href="index.php">login</a>.</p>
    </div>
</div>
</body>
</html>
