<?php
$servername = "localhost";
$username = "root";
$password = "root789";
$dbname = "chit_fund3";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action'])) {
    if ($_GET['action'] == 'get_schemes') {
        $sql = "SELECT * FROM ongoing_scheme";
        $result = $conn->query($sql);

        echo "<table border='1'>
                <tr>
                    <th>Chit ID</th>
                    <th>Chit Name</th>
                    <th>Total members</th>
                    <th>Current month</th>
                    <th>Monthly Pay</th>
                    <th>Kasar</th>
                    <th>Current amount Bidded</th>
                    <th>Auction Status</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            $auctionStatus = $row['auctionstatus'] ? 'Yes' : 'No';
            echo "<tr>
                    <td>{$row['chit_id']}</td>
                    <td>{$row['chit_name']}</td>
                    <td>{$row['total_members']}</td>
                    <td>{$row['current_month']}</td>
                    <td>{$row['monthlypay']}</td>
                    <td>{$row['kasar']}</td>
                    <td>{$row['amount_bidded']}</td>
                    <td>{$auctionStatus}</td>
                    
                    
                  </tr>";
        }
        echo "</table>";
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action'])) {
    if ($_GET['action'] == 'join_scheme') {
        $chit_id = $_POST['chit_id'];
        $customer_id = $_POST['customer_id'];

        $sql = "SELECT COUNT(*) AS count FROM scheme_members WHERE chit_id = '$chit_id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $count = $row['count'];

        if ($count >= 10) {
            echo "Scheme is full";
        } else {
            $sql = "INSERT INTO scheme_members (chit_id, member_name) VALUES ('$chit_id', '$customer_id')";
            if ($conn->query($sql) == TRUE) {
                echo "Customer joined the scheme successfully";
            } else {
                echo "Error joining scheme: " . $conn->error;
            }
        }
    }
}
$conn->close();
?>
