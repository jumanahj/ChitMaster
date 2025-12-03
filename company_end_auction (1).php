<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>End Auction - Chit Fund Management</title>
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
    <?php
    $con = mysqli_connect("localhost", "root", "root789", "chit_fund3") or die("Connection Failed");

    if (isset($_POST['end_auction'])) {
        $chitid = $_POST['chitid'];

        $check_scheme = "SELECT * FROM ongoing_scheme WHERE chit_id = '$chitid'";
        $scheme_result = mysqli_query($con, $check_scheme);

        if (mysqli_num_rows($scheme_result) > 0) {

            $scheme = mysqli_fetch_assoc($scheme_result);

            $update_0 = "UPDATE ongoing_scheme SET auctionstatus = 0 WHERE chit_id = '$chitid'";

            if (mysqli_query($con, $update_0)) {

                //$increment_month = "UPDATE ongoing_scheme SET current_month = current_month + 1 WHERE chit_id = '$chitid'";
                //if (mysqli_query($con, $increment_month)) {

                    $query="SELECT customer_bidded, amount_bidded, current_month FROM ongoing_scheme WHERE chit_id ='$chitid' ";
                    $execute=mysqli_query($con,$query);
                    $ongoingscheme_details=mysqli_fetch_assoc($execute);
                    //Fetching details
                    if($ongoingscheme_details['current_month'] != 1) {
                        $customer_id = $ongoingscheme_details['customer_bidded'];
                        $current_month = $ongoingscheme_details['current_month'];
                        $amount_bidded = $ongoingscheme_details['amount_bidded'];

                        //Inserting into customer_bidded table
                        $query="INSERT INTO customers_bidded(chit_id, customer_bidded, amount, on_month) 
                        VALUES ('$chitid', '$customer_id', '$amount_bidded', $current_month)";
                        if (mysqli_query($con, $query)) {
                            echo "<script> alert('The winner of the auction is $customer_id') </script>"; 
                        }
                    }

                    echo "<script> alert('Auction for scheme ID $chitid has been successfully ended') </script>";

                //} else {
                //   echo "Error incrementing current month: " . mysqli_error($con);
                }
            } else {
                echo "Scheme with ID $chitid does not exist ";
            } 
        }

    ?>
    <form method="POST" action="">
        <label for="chitid">Chit ID</label>
        <input type="text" name="chitid" placeholder="CHIT ID" required>
        <br>
        <input type="submit" name="end_auction" value="End Auction"> 
    </form>
</body>
</html>
