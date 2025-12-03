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
    <title>CURRENT SCHEMES</title>
    <style>
        th, td {
            padding: 1%;
            width: 10%;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <table border="1">
        <tr>
            <th>CHIT ID</th>
            <th>CHIT NAME</th>
            <th>DURATION</th>
            <th>TOTAL MEMBERS</th>
            <th>TOTAL AMOUNT</th>
            <th>COMMISSION PERCENT</th>
            <th>EXPECTED STARTING DATE</th>
            <th>APPLY</th>
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
                <td></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
