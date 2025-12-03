<?php
$con = mysqli_connect("localhost", "root", "root789", "chit_fund3") or die("Connection Failed");

if (isset($_POST['start_auction'])) {

    $chitid = $_POST['chitid'];

    //Check is the scheme exits
    $query=mysqli_query($con,"select * from schemes where chit_id ='$chitid'");
    if(mysqli_num_rows($query)==0)
    {
        echo "<script> alert('Invalid scheme id') </script>";
        exit();
    }
    $schemedata=mysqli_fetch_assoc($query);

    //check is the scheme started
    $check_scheme = "SELECT * FROM ongoing_scheme WHERE chit_id = '$chitid'";
    $execute=mysqli_query($con,$check_scheme);
    //$ongoingdata=mysqli_num_rows($execute);
    $ongoingdata=mysqli_fetch_assoc($execute);    
    if(mysqli_num_rows($execute)==0);
    {
        echo "<script> alert('Scheme is not started yet') </script>";
        exit();
    }
    if($schemedata['duration']==$ongoingdata['current_month'])
    {
        echo "<script> alert('Auctionas hs limit reached for this scheme') </script>";
        exit();
        
    }

    
    //incrementing month

    //Checking if the scheme reached its max months
    $execute=mysqli_query($con,"select duration from schemes where chit_id ='$chitid'");
    $schemedata=mysqli_fetch_assoc($execute);

    
    



    $increment_month = mysqli_query($con,"UPDATE ongoing_scheme SET current_month = current_month + 1 WHERE chit_id = '$chitid'");
    
    //setting minimum bidding amount
    $query="select totalamount,commissionpercent,totalcount from schemes where chit_id='$chitid' ";
    $execute=mysqli_query($con,$query);
    $data=mysqli_fetch_assoc($execute);

    $monthly_pay = ($data['totalamount'] / $data['totalcount']) ;//(($data['totalamount']/100)*$data['commissionpercent']);

    $minimum_bid=$data['totalamount']-(($data['totalamount']/100)*$data['commissionpercent']);

    //Resetting the bid amount and bidded customer
    $query="update ongoing_scheme set amount_bidded = '$minimum_bid',customer_bidded = 'null' where chit_id = '$chitid' ";
    $execute=mysqli_query($con,$query);

    $placeholder="NO ONE STARTED";

    $scheme_result = mysqli_query($con, $check_scheme);

    if (mysqli_num_rows($scheme_result) > 0) {
        $scheme = mysqli_fetch_assoc($scheme_result);

        $update_1= "UPDATE ongoing_scheme SET auctionstatus = 1,customer_bidded='$placeholder',amount_bidded='$minimum_bid',
        monthlypay='$monthly_pay' WHERE chit_id = '$chitid'";


        if (mysqli_query($con, $update_1)) {
            echo "Auction for scheme ID $chitid has been successfully started.";

           
        } else {
            echo "Error updating auction status: " . mysqli_error($con);
        }
    } else {
        echo "Scheme with ID $chitid does not exist";
    }
}

mysqli_close($con);
?>

<html>
     <head>
    <title>Start Auction</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #141E30, #243B55);
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }
        .auction-form {
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            width: 400px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            text-align: center;
        }
        .auction-form h1 {
            font-size: 30px;
            color: #FFFFFF;
            text-align: center;
            margin-bottom: 20px;
            opacity: 0.9;
        }
        .auction-form label {
            font-size: 16px;
            color: #FFFFFF;
            margin-bottom: 5px;
            display: block;
        }
        .auction-form input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .auction-form input[type="submit"] {
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
        .auction-form input[type="submit"]:hover {
            background: #243B55;
            color: #FFFFFF;
        }
    </style>
</head>
<body>
    <div class="auction-form">
        <h1>Start Auction</h1>
        <form method="POST" action="company_start_auction (1).php">
            <label for="chitid">Chit ID</label>
            <input type="text" name="chitid" placeholder="CHIT ID" required>
            <br>
            <input type="submit" name="start_auction" value="Start Auction"> 
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
