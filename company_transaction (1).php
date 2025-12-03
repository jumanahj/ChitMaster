<?php
if (isset($_POST['pay'])) {
    $username = $_POST['username'];
}
?>

<?php
if (isset($_POST['transaction'])) {   
    $con = mysqli_connect("localhost", "root", "root789", "chit_fund3");

    $transaction_id = $_POST['transaction_id'];
    $ifsc = $_POST['ifsccode'];
    $amount = $_POST['amount'];
    $user_id = $_POST['customer_id'];
    $chit_id = $_POST['chit_id'];

    $query = mysqli_query($con, "SELECT * FROM schemes WHERE chit_id='$chit_id'");

    if (mysqli_num_rows($query) == 0) {
        echo "<script>alert('Invalid Scheme Id')</script>";
        exit();
    }

    // Fetching month
    $query = "SELECT current_month FROM ongoing_scheme WHERE chit_id='$chit_id'";
    $result = mysqli_query($con, $query);
    $ongoing_scheme_data = mysqli_fetch_assoc($result);

    $query = "SELECT * FROM users WHERE account_no ='$transaction_id'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 0) {
        echo "<script>alert('Invalid transaction Id')</script>";
        exit(); 
    }

    $userdata = mysqli_fetch_assoc($result);
    // User details
    $user_id = $userdata['username'];
    $year = date('Y');
    $current_month = $ongoing_scheme_data["current_month"];

    $query = "INSERT INTO company_monthly_payments(user_id, chit_id, month, year, amount)
              VALUES('$user_id', '$chit_id', '$current_month', '$year', '$amount')";
    
    if (mysqli_query($con, $query)) {
        echo "<script>alert('Transaction Successful')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Transaction</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: linear-gradient(to right, #555, #243B55);
            font-family: 'Poppins', sans-serif;
            margin: 0;
            color: #fff;
        }
        div {
            border: 1px solid #ddd;
            height: auto;
            width: 300px;
            border-radius: 10px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        form label {
            display: block;
            margin: 10px 0 5px;
            font-size: 14px;
        }
        form input[type="text"], form input[type="number"] {
            width: calc(100% - 20px);
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            margin-bottom: 10px;
            background: #fff;
            color: #000;
        }
        form input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: #243B55;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        form input[type="submit"]:hover {
            background: #141E30;
        }
    </style>
</head>
<body>
    <div>
        <form method="POST">
            <input type="hidden" value="<?php echo isset($username) ? $username : ''; ?>" name="customer_id" style="display:none;">
            <label for="transaction_id">BANK ACCOUNT NO</label>
            <input type="text" placeholder="TRANSACTION ID" name="transaction_id" required>
            <label for="ifsccode">IFSC CODE</label>
            <input type="text" placeholder="IFSC" name="ifsccode" required>
            <label for="chit_id">FROM SCHEME</label>
            <input type="text" name="chit_id" placeholder="CHITXXX" required>
            <label for="amount">AMOUNT</label>
            <input type="number" placeholder="AMOUNT" name="amount" required>
            <input type="submit" value="Pay" name="transaction">
        </form>
    </div>
</body>
</html>
