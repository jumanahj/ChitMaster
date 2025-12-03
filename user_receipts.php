<?php

if (isset($_POST['userreceipts'])) {
    $username = $_POST['username'];
    echo "$username";
}

// Database connection
$con = mysqli_connect("localhost", "root", "root789", "chit_fund3");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch payment details
$query = "SELECT * FROM user_monthly_payments where user_id='$username'";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

// Fetch all results into an array
$payments = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Close the connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .receipt {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #444;
            color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .receipt h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .receipt table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .receipt table, .receipt th, .receipt td {
            border: 1px solid #ddd;
        }
        .receipt th, .receipt td {
            padding: 8px;
            text-align: left;
        }
        .receipt th {
            background-color: #f2f2f2;
        }
        .receipt td {
            background-color: #fff;
        }
        .receipt p {
            text-align: center;
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <h2>Payment Receipt</h2>
        <?php if (!empty($payments)): ?>
        <table>
            <tr>
                <th>Payment ID</th>
                <th>User ID</th>
                <th>Chit ID</th>
                <th>Month</th>
                <th>Year</th>
                <th>Amount</th>
                <th>Payment Date</th>
                <th>Status</th>
            </tr>
            <?php foreach ($payments as $payment): ?>
            <tr>
                <td><?php echo $payment['payment_id']; ?></td>
                <td><?php echo $payment['user_id']; ?></td>
                <td><?php echo $payment['chit_id']; ?></td>
                <td><?php echo $payment['month']; ?></td>
                <td><?php echo $payment['year']; ?></td>
                <td><?php echo $payment['amount']; ?></td>
                <td><?php echo $payment['payment_date']; ?></td>
                <td><?php echo ucfirst($payment['payment_status']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php else: ?>
        <p>No payment receipts found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
