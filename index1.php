<?php
$conn = new mysqli("localhost", "root", "root789", "chit_fund3");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling POST requests to join a scheme
if (isset($_POST['submit'])) {
    $chit_id = $_POST['chit_id'];
    $customer_id = $_POST['customer_id'];

    // Check if the scheme is full (already has 10 members)
    $sql_count = "SELECT COUNT(*) AS count FROM scheme_members WHERE chit_id = '$chit_id'";
    $result_count = $conn->query($sql_count);
    $row_count = $result_count->fetch_assoc();
    $count = $row_count['count'];

    if ($count >= 10) {
        echo "Scheme is full";
    } else {
        // Insert the member into scheme_members table
        $sql_insert = "INSERT INTO scheme_members (chit_id, member_name) VALUES ('$chit_id', '$customer_id')";
        if ($conn->query($sql_insert) === TRUE) {
            echo "Customer joined the scheme successfully";
        } else {
            echo "Error joining scheme: " . $conn->error;
        }
    }
}

$conn->close();
?>
