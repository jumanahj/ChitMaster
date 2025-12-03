<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start Scheme - Chit Fund Management</title>
    <style>
        /* General Styles */
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
    </style>
</head>
<body>
    <?php
    $con = mysqli_connect("localhost", "root", "root789", "chit_fund3") or die("Connection Failed");

    if (isset($_POST['start'])) {
        $chitid = $_POST['chitid'];

        $check_scheme = "SELECT * FROM schemes WHERE chit_id = '$chitid'";
        $scheme_result = mysqli_query($con, $check_scheme);

        if (mysqli_num_rows($scheme_result) > 0) {
            $scheme = mysqli_fetch_assoc($scheme_result);

            $monthly_pay = ($scheme['totalamount'] / $scheme['totalcount']);
            $totalmembers = $scheme['totalcount'];

            // Checking if the required members joined or not
            $slots = mysqli_query($con, "SELECT currentcount, count FROM scheme_slots WHERE chit_id='$chitid'");
            $result = mysqli_fetch_assoc($slots);

            if ($result['currentcount'] != $result['count']) {
                echo "<script> alert('Required members haven\'t joined yet') </script>";
                exit();
            }
            $kasar = 0;

            // Inserting into ongoing_scheme
            $insert = "INSERT INTO ongoing_scheme (chit_id, chit_name, auctionstatus, monthlypay, kasar, commission_percent, amount_bidded, current_month, total_members, totalamount)
                       VALUES ('{$scheme['chit_id']}', '{$scheme['name']}', 0, '$monthly_pay', '$kasar', '{$scheme['commissionpercent']}', 0, 1, '$totalmembers', '{$scheme['totalamount']}')";

            if (mysqli_query($con, $insert)) {
                echo "<script> alert('Scheme ID $chitid has been successfully started') </script>";
                // Closing the scheme slots
                $query = mysqli_query($con, "UPDATE scheme_slots SET opened='1' WHERE chit_id='$chitid'");
            } else {
                echo "Error: " . mysqli_error($con);
            }
        } else {
            echo "Scheme with ID $chitid does not exist in the schemes table.";
        }
    }
    mysqli_close($con);
    ?>

    <form method="POST" action="">
        <label for="chitid">Enter the scheme ID:</label>
        <input type="text" name="chitid" required>
        <br>
        <input type="submit" name="start" value="Start">
    </form>
</body>
</html>
