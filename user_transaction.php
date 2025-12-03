<?php
if (isset($_POST['pay'])) {
    $username = $_POST['username'];
    //echo "$username";
}
?>

<?php
if (isset($_POST['transaction'])) {   
    $transaction_id = $_POST['transaction_id'];
    $ifsc = $_POST['ifsccode'];
    $amount = $_POST['amount'];
    $user_id = $_POST['customer_id'];

    $con = mysqli_connect("localhost", "root", "root789", "chit_fund3");

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieving the chit id
    $query = "SELECT * FROM schemes WHERE transaction_id = '$transaction_id'";
    $result = mysqli_query($con, $query);
    
    // Check if the query was successful
    if (!$result) {
        echo "<script>alert('Query failed: " . mysqli_error($con) . "');</script>";
        exit();
    }

    // Checking if the transaction id exists
    if (mysqli_num_rows($result) == 0) {
        echo "<script>alert('Invalid transaction Id');</script>";
        exit();
    }

    $scheme_data = mysqli_fetch_assoc($result);
    $chit_id = $scheme_data['chit_id'];

    // Updating current month from ongoing table
    $query = "SELECT current_month FROM ongoing_scheme WHERE chit_id = '$chit_id'";
    $execute = mysqli_query($con, $query);
    
    // Check if the query was successful
    if (!$execute) {
        echo "<script>alert('Query failed: " . mysqli_error($con) . "');</script>";
        exit();
    }

    $ongoing_scheme_data = mysqli_fetch_assoc($execute);
    
    // Check if ongoing_scheme_data is not null
    if (!$ongoing_scheme_data) {
        echo "<script>alert('No ongoing scheme found for the given chit_id');</script>";
        exit();
    }

    // Get the current month and year
    $current_month = $ongoing_scheme_data['current_month']; // Numeric representation of the month
    $current_year = date('Y');

    $query = "INSERT INTO user_monthly_payments (user_id, chit_id, month, year, amount)
              VALUES ('$user_id', '$chit_id', '$current_month', '$current_year', '$amount')";
    
    if (mysqli_query($con, $query)) {
        echo "<script>alert('Payment Successful');</script>";
    } else {
        echo "<script>alert('Payment failed: " . mysqli_error($con) . "');</script>";
    }

    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:#FAF9F6;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 300px;
            padding: 20px;
            background-color: #333;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            border-radius: 8px;
        }

        .container form {
            display: flex;
            flex-direction: column;
        }

        .container label {
            margin-bottom: 6px;
            font-weight: bold;
            color: #fff;
        }

        .container input[type="text"],
        .container input[type="number"] {
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #aaa;
            border-radius: 4px;
            font-size: 14px;
            background-color: #666;
            color: #fff;
        }

        .container input[type="submit"] {
            background-color: #fff;
            color: black;
            border: none;
            padding: 12px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .container input[type="submit"]:hover {
            background-color: #D3D3D3;
        }
    </style>
</head>
<body>

<div class="container">
    <form method="POST">
        <input type="hidden" value="<?php echo isset($username) ? $username : ''; ?>" name="customer_id">
        
        <label for="transaction_id">Transaction ID</label>
        <input type="text" placeholder="Enter Transaction ID" name="transaction_id" required>
        
        <label for="ifsccode">IFSC Code</label>
        <input type="text" placeholder="Enter IFSC Code" name="ifsccode" required>
        
        <label for="amount">Amount</label>
        <input type="number" placeholder="Enter Amount" name="amount" required>
        
        <input type="submit" value="Pay" name="transaction">
    </form>
</div>

</body>
</html>
