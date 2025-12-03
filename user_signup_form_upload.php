<<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $userstatus = $_POST['userstatus'];
    $dob = $_POST['dob'];
    $aadhar = $_POST['aadhar'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $usergender = $_POST['usergender'];
    $phone = $_POST['phone'];
    $occupation = $_POST['occupation'];
    $retirement_year = $_POST['retirement_year'];
    $family_count = $_POST['family_count'];
    $account_no = $_POST['account_no'];
    $monthly_income = $_POST['monthly_income'];
    $savings = $_POST['savings'];
    $useremi = $_POST['useremi'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        die("Passwords do not match.");
    }

 
    // Database connection
    $servername = "localhost";
    $username_db = "root";  
    $password_db = "root789";  
    $dbname = "chit_fund3"; 
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO users (name, userstatus, dob, aadhar, address, email, usergender, phone, occupation, retirement_year, family_count, account_no, monthly_income, savings, useremi, username, pass) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssiiissss", $name, $userstatus, $dob, $aadhar, $address, $email, $usergender, $phone, $occupation, $retirement_year, $family_count, $account_no, $monthly_income, $savings, $useremi, $username, $password);

    if ($stmt->execute()) {
        header("Location: user_login_page.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
