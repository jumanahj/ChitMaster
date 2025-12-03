<?php
$connect = mysqli_connect("localhost", "root", "root789", "chit_fund3") or die("Connection failed");

$sql = "SELECT * FROM users";
$result = mysqli_query($connect, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                overflow-x: hidden;
            }
            .table-container {
                width: 90%;
                overflow-x: auto;
            }
            table {
                border-collapse: collapse;
                width: 100%;
                margin: 20px 0;
                font-size: 14px;
                min-width: 1000px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
                background-color: #fff;
            }
            th, td {
                padding: 12px 15px;
                text-align: left;
            }
            th {
                background-color: #3a3a3a;
                color: #ffffff;
            }
            tr {
                border-bottom: 1px solid #dddddd;
            }
            tr:nth-of-type(even) {
                background-color: #f2f2f2;
            }
            tr:nth-of-type(odd) {
                background-color: #e6e6e6;
            }
            tr:last-of-type {
                border-bottom: 2px solid #3a3a3a;
            }
          </style>";

    echo "<div class='table-container'><table>";
    echo "<tr><th>ID</th><th>Name</th><th>User Status</th><th>DOB</th><th>Aadhar</th><th>Address</th><th>Email</th><th>Gender</th><th>Phone</th><th>Occupation</th><th>Retirement Year</th><th>Family Count</th><th>Account No</th><th>Monthly Income</th><th>Savings</th><th>EMI</th></tr>";

    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["name"]."</td>";
        echo "<td>".$row["userstatus"]."</td>";
        echo "<td>".$row["dob"]."</td>";
        echo "<td>".$row["aadhar"]."</td>";
        echo "<td>".$row["address"]."</td>";
        echo "<td>".$row["email"]."</td>";
        echo "<td>".$row["usergender"]."</td>";
        echo "<td>".$row["phone"]."</td>";
        echo "<td>".$row["occupation"]."</td>";
        echo "<td>".$row["retirement_year"]."</td>";
        echo "<td>".$row["family_count"]."</td>";
        echo "<td>".$row["account_no"]."</td>";
        echo "<td>".$row["monthly_income"]."</td>";
        echo "<td>".$row["savings"]."</td>";
        echo "<td>".$row["useremi"]."</td>";
        echo "</tr>";
    }
    echo "</table></div>";
} else {
    echo "0 results";
}

$connect->close();
?>
