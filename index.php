<?php
include 'db.php';
session_start();

if(isset($_POST['username'], $_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password, $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['first_name'] = $user['first_name'];
        header("Location: records.php");
        exit;
    } else {
        $error = "Invalid student number or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="styleregister.css">
<title>Smart Campus Hub</title>
<link rel="shortcut icon" type="image/png" href="cake.png">
</head>
<body>
<div class="container">
    <div class="logo-box">
        <img src="cake.png" alt="Smart Campus Hub Logo">
    </div>
    <div class="login-box">
        <h2>SIGN IN</h2>
        <form method="POST" action="index.php">
            <input type="text" name="username" placeholder="Student Number" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Sign In</button>
        </form>
        <a href="register.html" class="create">Create an Account</a>
        <p class="terms">
            By clicking continue, you agree to our 
            <a href="Termsofservice.html">Terms of Service</a> and 
            <a href="Privacypolicy.html">Privacy Policy</a>.
        </p>
        <?php if(isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    </div>
</div>
</body>
</html>
