<?php
$connect = mysqli_connect("localhost", "root", "root789", "chit_fund3") or die("Connection failed");

$sql = "SELECT 
            os.chit_id,
            os.chit_name,
            os.auctionstatus,
            os.monthlypay,
            os.kasar,
            os.commission_percent,
            os.amount_bidded,
            os.current_month,
            os.total_members,
            os.totalamount,
            ss.member1, ss.member2, ss.member3, ss.member4, ss.member5,
            ss.member6, ss.member7, ss.member8, ss.member9, ss.member10,
            ss.member11, ss.member12, ss.member13, ss.member14, ss.member15,
            ss.member16, ss.member17, ss.member18, ss.member19, ss.member20,
            ss.member21, ss.member22, ss.member23, ss.member24, ss.member25,
            ss.member26, ss.member27, ss.member28, ss.member29, ss.member30
        FROM 
            ongoing_scheme os
        LEFT JOIN 
            scheme_slots ss ON os.chit_id = ss.chit_id
        LIMIT 0, 1000";

$result = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ongoing Schemes</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #868383;
            color: #fff;
            margin: 20px;
        }
        .container {
            width: 100%;
            margin: auto;
            overflow: hidden;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 14px;
            text-align: left;
            background-color: #222;
        }
        table th, table td {
            padding: 8px 10px;
            border: 1px solid #444;
        }
        table th {
            background-color: #555;
            color: #fff;
            text-transform: uppercase;
        }
        table tr:nth-child(even) {
            background-color: #333;
        }
        table tr:hover {
            background-color: #444;
        }
        .heading {
            text-align: center;
            margin: 20px 0;
        }
        .member-table {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .member-table .member-column {
            flex: 1;
            min-width: 150px;
            margin: 10px;
        }
        .member-table th, .member-table td {
            text-align: center;
            border: 1px solid #444;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="heading">Ongoing Schemes</h1>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div>";
                echo "<table>";
                echo "<tr><th>Chit ID</th><td>".$row["chit_id"]."</td></tr>";
                echo "<tr><th>Chit Name</th><td>".$row["chit_name"]."</td></tr>";
                echo "<tr><th>Auction Status</th><td>".($row["auctionstatus"] ? "Yes" : "No")."</td></tr>";
                echo "<tr><th>Monthly Pay</th><td>".$row["monthlypay"]."</td></tr>";
                echo "<tr><th>Kasar</th><td>".$row["kasar"]."</td></tr>";
                echo "<tr><th>Commission Percent</th><td>".$row["commission_percent"]."</td></tr>";
                echo "<tr><th>Amount Bidded</th><td>".$row["amount_bidded"]."</td></tr>";
                echo "<tr><th>Current Month</th><td>".$row["current_month"]."</td></tr>";
                echo "<tr><th>Total Members</th><td>".$row["total_members"]."</td></tr>";
                echo "<tr><th>Total Amount</th><td>".$row["totalamount"]."</td></tr>";
                echo "</table>";
               
                echo "<h3>Members in this Scheme</h3><br>";
               
                echo "<div class='member-table'>";
               
                for ($col = 0; $col < 5; $col++) {
                    echo "<div class='member-column'>";
                    echo "<table>";
                    echo "<tr><th>Member</th><th>Name</th></tr>";
                    for ($row_num = 1; $row_num <= 6; $row_num++) {
                        $member_index = $col * 6 + $row_num;
                        $member = $row["member" . $member_index];
                        if (!empty($member)) {
                            echo "<tr><td>Member $member_index</td><td>$member</td></tr>";
                        }
                    }
                    echo "</table>";
                    echo "</div>";
                }
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No ongoing schemes found.</p>";
        }
        $connect->close();
        ?>
    </div>

</body>
</html>
