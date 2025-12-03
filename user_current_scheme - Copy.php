<?php
$con = mysqli_connect("localhost", "root", "root789", "chit_fund3");

if ($con) {
    // Connection successful
} else {
    // Connection failed
}

$query = "SELECT * FROM schemes";
$result = mysqli_query($con, $query);
$schemes = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Current Schemes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            width: 90%;
            max-width: 1200px;
        }
        h1 {
            color: #fff;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #444;
            color: #fff;
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #555;
        }
        th {
            background-color: #555;
        }
        tr:nth-child(even) {
            background-color: #555;
        }
        tr:nth-child(odd) {
            background-color: #444;
        }
        tr:hover {
            background-color: #666;
        }
        .apply-btn {
            background-color: #fff;
            color: #333;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .apply-btn:hover {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Current Schemes</h1>
        <table>
            <tr>
                <th>Chit ID</th>
                <th>Chit Name</th>
                <th>Duration</th>
                <th>Total Members</th>
                <th>Total Amount</th>
                <th>Commission Percent</th>
                <th>Expected Starting Date</th>
                <th>Apply</th>
            </tr>
            <?php foreach ($schemes as $scheme) { ?>
                <tr>
                    <td><?php echo $scheme['chit_id']; ?></td>
                    <td><?php echo $scheme['name']; ?></td>
                    <td><?php echo $scheme['duration']; ?></td>
                    <td><?php echo $scheme['totalcount']; ?></td>
                    <td><?php echo $scheme['totalamount']; ?></td>
                    <td><?php echo $scheme['commissionpercent']; ?></td>
                    <td><?php echo $scheme['startingdate']; ?></td>
                    <td><a href="user_login_page.php" class="apply-btn">Apply</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
