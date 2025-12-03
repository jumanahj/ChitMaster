<?php
    /*include('scheme_upload.php');
    {
    die("Connection Error".mysqli_connect_error());
    }*/
    if(isset($_POST['create_scheme']))
    {
        $transaction_id=$_POST['transaction_id'];
    }    
    
    if(isset($_POST['create']))
    {
        $con= mysqli_connect("localhost","root","root789","chit_fund3");
        //if($con == false)
        $sec_con=mysqli_connect("localhost","root","root789","chit_fund3");

        $SchemeName=$_POST['schemename'];
        $TotalAMount=$_POST['totalamount'];
        $TotalMembers=$_POST['totalcount'];
        $SchemeDuration=$_POST['schemeduration'];
        $SchemeCommission=$_POST['schemecommission'];
        $StartingDate=$_POST['startingdate'];
        $TransactionId=$_POST['transactionid'];
        //$TransactionId=$_POST['transaction_id'];
        //echo "the transaction id is".$transaction_id;
        //Generating shuffle code for chid id
        $random= uniqid('',true);
        $shortened_id = substr(md5($random), 0, 4); 
        $id="chit".$shortened_id;

        if($SchemeDuration!=$TotalMembers)
        {
            ?> <script> alert('Month and members should be equal');</script><?php
            exit();
        }
        $query=mysqli_query($con,"insert into schemes(chit_id,name,totalamount,totalcount,duration,commissionpercent,startingdate,transaction_id) values 
        ('$id','$SchemeName','$TotalAMount',' $TotalMembers','$SchemeDuration','$SchemeCommission','$StartingDate','$TransactionId')");
        $query=mysqli_query($con,"insert into scheme_slots(chit_id,opened,count,currentcount) values('$id',true,'$TotalMembers','0')");
      /*  $query=mysqli_query($sec_con,"insert into month(chit_id,transactionid) values('$id','$TransactionId')"); */
        ?> 
        <script> alert('The scheme is successfully created ')</script>
        <?php
        /*  if($query)
        {
            echo <script>alert(Inserted successfully) </script>;
        }
        else
        {
            echo <script>alert(Error occurred) </script>;
        }
        */
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCHEME CREATION</title>
    <style>
        body {
            display: flex;
            padding: 100px;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #141E30, #243B55);
            margin: 0;
            font-family: 'Roboto', sans-serif;
        }
        .auction-form {
            background: rgba(255, 255, 255, 0.1);
            padding: 60px;
            border-radius: 12px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            height: 100vh;
            max-width: 600px;
            border-radius: 20px;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(235, 235, 235, 0.8);
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .auction-form h1 {
            font-size: 28px;
            color: #FFFFFF;
            text-align: center;
            margin-bottom: 15px;
        }
        .auction-form label {
            font-size: 16px;
            color: #FFFFFF;
            margin-bottom: 5px;
            display: block;
            text-align: left;
            width: 100%;
        }
        .auction-form input[type="text"],
        .auction-form input[type="number"],
        .auction-form input[type="date"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 18px;
            box-sizing: border-box;
            background: rgba(255, 255, 255, 0.2);
            color: #FFFFFF;
        }
        .auction-form input[type="text"]::placeholder,
        .auction-form input[type="number"]::placeholder,
        .auction-form input[type="date"]::placeholder {
            color: #ccc;
        }
        .auction-form input[type="submit"] {
            background: #4CAF50;
            color: #FFFFFF;
            font-size: 16px;
            border-radius: 5px;
            width: 100%;
            padding: 15px;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
            box-sizing: border-box;
        }
        .auction-form input[type="submit"]:hover {
            background: #45A049;
        }
        @media (max-width: 600px) {
            .auction-form {
                width: 90%;
                padding: 20px;
            }
            .auction-form h1 {
                font-size: 24px;
            }
            .auction-form label {
                font-size: 14px;
            }
            .auction-form input[type="text"],
            .auction-form input[type="number"],
            .auction-form input[type="date"],
            .auction-form input[type="submit"] {
                font-size: 12px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
<div class="auction-form">
    <h1>SCHEME CREATION</h1>
    <form method="POST">
        <label for="schemename">SCHEME NAME</label>
        <input type="text" id="schemename" name="schemename" placeholder="Enter scheme name">

        <label for="totalamount">TOTAL AMOUNT</label>
        <input type="number" id="totalamount" name="totalamount" placeholder="Enter total amount">

        <label for="totalcount">TOTAL MEMBERS</label>
        <input type="number" id="totalcount" name="totalcount" placeholder="Enter total members">

        <label for="schemeduration">DURATION (MONTHS)</label>
        <input type="number" id="schemeduration" name="schemeduration" placeholder="Enter duration in months">

        <label for="schemecommission">COMMISSION PERCENT</label>
        <input type="number" id="schemecommission" name="schemecommission" placeholder="Enter commission percent">

        <label for="transactionid">TRANSACTION ID</label>
        <input type="text" id="transactionid" name="transactionid" placeholder="Enter transaction ID">

        <label for="startingdate">EXPECTED STARTING DATE</label>
        <input type="date" id="startingdate" name="startingdate">

        <!-- Sending transaction id as hidden input 
        <input type="hidden" value='<?php //echo $transaction_id ;?>' name="transaction_id">
        -->

        <input type="submit" value="Create" name="create">
    </form>
</div>
</body>
</html>
