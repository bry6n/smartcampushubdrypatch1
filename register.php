<?php
include 'db.php';
session_start();

function generateStudentNumber($length = 6) {
    return 'S' . substr(str_shuffle('0123456789'), 0, $length);
}

if(isset($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Ensure email is unique BEFORE inserting
    $stmt_email = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt_email->execute([$email]);
    if($stmt_email->fetchColumn() > 0){
        echo "Error: Email already registered.";
        exit;
    }

    // Generate unique student number
    $student_number = generateStudentNumber();
    $stmt_check = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $stmt_check->execute([$student_number]);
    while($stmt_check->fetchColumn() > 0){
        $student_number = generateStudentNumber();
        $stmt_check->execute([$student_number]);
    }

    // Assign random program
    $program_stmt = $conn->query("SELECT id FROM programs ORDER BY RAND() LIMIT 1");
    $program_id = $program_stmt->fetchColumn();

    // Insert user
    $stmt = $conn->prepare("
        INSERT INTO users (username, first_name, last_name, email, password, program_id)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    if($stmt->execute([$student_number, $first_name, $last_name, $email, $password, $program_id])){
        $_SESSION['student_number'] = $student_number;
        $_SESSION['first_name'] = $first_name;
        header("Location: register_success.php");
        exit;
    } else {
        echo "Error registering user.";
    }
}
?>
