<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.'); window.location.href = 'user_reset_password.php?username=" . $username . "';</script>";
        exit();
    }

   
    $servername = "localhost";
    $username_db = "root";  
    $password_db = "root789";  
    $dbname = "chit_fund3";  

    
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $stmt = $conn->prepare("UPDATE users SET pass = ? WHERE username = ?");
    $stmt->bind_param("ss", $password, $username);

    if ($stmt->execute()) {
        echo "<script>alert('Password updated successfully.'); window.location.href = 'user_login_page.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
