<?php

if (isset($_POST['submit'])) {
    
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

    
    $annual_income = $monthly_income * 12;
    $account_balance = $savings * 12;

    
    $servername = "localhost";
    $username_db = "root";
    $password_db = "root789";
    $dbname = "chit_fund3";

    
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $stmt_users = $conn->prepare("INSERT INTO users (name, userstatus, dob, aadhar, address, email, usergender, phone, occupation, retirement_year, family_count, account_no, monthly_income, savings, useremi, username, pass) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt_users->bind_param("ssssssssssiiissss", $name, $userstatus, $dob, $aadhar, $address, $email, $usergender, $phone, $occupation, $retirement_year, $family_count, $account_no, $monthly_income, $savings, $useremi, $username, $password);

    
    if ($stmt_users->execute()) {
        
        $user_id = $stmt_users->insert_id;

        
        $stmt_accounts = $conn->prepare("INSERT INTO user_accounts (id, username, account_no, annual_income, account_balance) VALUES (?, ?, ?, ?, ?)");
        $stmt_accounts->bind_param("isiii", $user_id, $username, $account_no, $annual_income, $account_balance);

        
        if ($stmt_accounts->execute()) {
            
            header("Location: user_login_page.php");
            exit;
        } else {
            echo "Error inserting into user_accounts: " . $stmt_accounts->error;
        }
    } else {
        echo "Error inserting into users: " . $stmt_users->error;
    }

    
    $stmt_users->close();
    $stmt_accounts->close();
    $conn->close();
}
?>
