<?php
$chit = null;
$error = null;


if (isset($_POST['submit'])) {
    
    $conn = new mysqli("localhost", "root", "root789", "chit_fund3");

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

        $chit_id = $_POST['chit_id'];

    
    $sql = "SELECT * FROM schemes WHERE chit_id = '$chit_id'";
    $result = $conn->query($sql);

    
    if ($result && $result->num_rows > 0) {
        $chit = $result->fetch_assoc();
    } else {
        $error = "No results found for Chit ID: " . $chit_id;
    }

    
    $conn->close();
}
?>

<html>
    <title>Search Chit Fund</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Search Chit Fund by ID</h1>
    <form id="searchForm" method="post" action="user_search_chit.php">
        <label for="chit_id">Chit ID:</label>
        <input type="text" id="chit_id" name="chit_id" required>
        <button type="submit" name="submit">Search</button>
    </form>
-
    <h2>Chit Fund Details</h2>
    <table id="chitTable" border="1" style="border-collapse:collapse">
        <thead>
            <tr>
                <th>Chit ID</th>
                <th>Name</th>
                <th>Total Amount</th>
                <th>Total Count</th>
                <th>Duration</th>
                <th>Commission Percent</th>
                <th>Starting Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($chit): ?>
                <tr>
                    <td><?php echo $chit['chit_id']; ?></td>
                    <td><?php echo $chit['name']; ?></td>
                    <td><?php echo $chit['totalamount']; ?></td>
                    <td><?php echo $chit['totalcount']; ?></td>
                    <td><?php echo $chit['duration']; ?></td>
                    <td><?php echo $chit['commissionpercent']; ?></td>
                    <td><?php echo $chit['startingdate']; ?></td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="7"><?php echo $error; ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
