<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>End Scheme</title>
    <style>
        body {
            font-family: sans-serif;
            background: linear-gradient(to right, #141E30, #243B55);
            color: #FFFFFF;
            margin: 0;
            padding: 20px;
        }
        form {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            width: 400px;
            margin: 20px auto;
        }
        form label {
            font-size: 18px;
            color: #FFFFFF;
            display: block;
            text-align: left;
            margin-bottom: 10px;
        }
        form input[type="text"] {
            width: 50%; /* Reduced width */
            padding: 8px; /* Reduced padding */
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px; /* Reduced font size */
            margin-bottom: 20px;
        }
        form input[type="submit"] {
            background: #FFFFFF;
            color: #141E30;
            font-size: 16px;
            border-radius: 5px;
            width: 100%;
            padding: 10px;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        form input[type="submit"]:hover {
            background: #243B55;
            color: #FFFFFF;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        table, th, td {
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background: rgba(255, 255, 255, 0.2);
        }
        td {
            background: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body>

<h1>Schemes to be Ended</h1>

<form method="post">
    <label for="chit_id">Enter the chit ID:</label>
    <input type="text" id="chit_id" name="chit_id" required>
    <input type="submit" name="end" value="End">
</form>

<h2>Ended Schemes</h2>
<table>
    <tr>
        <th>Chit ID</th>
        <th>Chit Name</th>
        <th>Commission Percent</th>
        <th>Total Members</th>
        <th>Total Amount</th>
        <th>Ended Date</th>
    </tr>
    <?php
    if(isset($_POST['end'])) {
        $chit_id = $_POST['chit_id'];
        $con = mysqli_connect("localhost", "root", "root789", "chit_fund3");

        $query = "SELECT chit_name, commission_percent, total_members, totalamount, current_month FROM ongoing_scheme WHERE chit_id = '$chit_id'";
        $execute = mysqli_query($con, $query);
        $chit_details = mysqli_fetch_assoc($execute);

        $chit_name = $chit_details['chit_name'];
        $commission_percent = $chit_details['commission_percent'];
        $totalmembers = $chit_details['total_members'];
        $totalamount = $chit_details['totalamount'];
        $current_month = $chit_details['current_month'];

        $execute = mysqli_query($con, "SELECT duration FROM schemes WHERE chit_id = '$chit_id'");
        $scheme_data = mysqli_fetch_assoc($execute);
        $total_months = $scheme_data['duration'];

        if ($total_months == $current_month) {
            $query = "INSERT INTO ended_scheme (chit_id, chit_name, commission_percent, total_members, total_amount) 
                      VALUES ('$chit_id', '$chit_name', '$commission_percent', '$totalmembers', '$totalamount')";

            if (mysqli_query($con, $query)) {
                echo "<script>alert('Scheme ended successfully');</script>";
            } else {
                echo "<script>alert('Error occurred while closing the scheme');</script>";
            }
        } else if ($current_month < $total_months) {
            echo "<script>alert('Total duration of the scheme hasn\'t completed yet');</script>";
        } else if ($current_month > $total_months) {
            echo "<script>alert('CLOSE THE SCHEME MANUALLY IN THE DATABASE (DURATION CROSSED)');</script>";
        }
    }

    $con = mysqli_connect("localhost", "root", "root789", "chit_fund3");
    $query = "SELECT * FROM ended_scheme";
    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['chit_id']}</td>";
        echo "<td>{$row['chit_name']}</td>";
        echo "<td>{$row['commission_percent']}</td>";
        echo "<td>{$row['total_members']}</td>";
        echo "<td>{$row['total_amount']}</td>";
        echo "<td>{$row['ended_date']}</td>";
        echo "</tr>";
    }
    mysqli_close($con);
    ?>
</table>

</body>
</html>
