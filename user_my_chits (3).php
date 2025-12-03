<?php
    echo "<html> <h1>CHITS YOU HAVE ENROLLED</h1> </html>";
    if(isset($_POST['mychits']))
    {
        $username=$_POST['username'];
        echo $username;
    $con = mysqli_connect("localhost", "root", "root789", "chit_fund3");
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $query = "
    SELECT 
        os.chit_id, os.chit_name, os.auctionstatus, os.monthlypay, os.kasar, 
        os.commission_percent, os.amount_bidded, os.current_month, 
        os.total_members, os.customer_bidded
    FROM 
        ongoing_scheme os
    JOIN 
        scheme_slots ss ON os.chit_id = ss.chit_id
    WHERE 
        '$username' IN (ss.member1, ss.member2, ss.member3, ss.member4, ss.member5, 
                        ss.member6, ss.member7, ss.member8, ss.member9, ss.member10, 
                        ss.member11, ss.member12, ss.member13, ss.member14, ss.member15, 
                        ss.member16, ss.member17, ss.member18, ss.member19, ss.member20, 
                        ss.member21, ss.member22, ss.member23, ss.member24, ss.member25, 
                        ss.member26, ss.member27, ss.member28, ss.member29, ss.member30);
    ";

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "
        <table border='1'>
                <tr>
                    <th>Chit ID</th>
                    <th>Chit Name</th>
                    <th>Auction Status</th>
                    <th>Monthly Pay</th>
                    <th>Kasar</th>
                    <th>Commission Percent</th>
                    <th>Amount Bidded</th>
                    <th>Current Month</th>
                    <th>Total Members</th>
                    <th>Customer Bidded</th>
                </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row['chit_id'] . "</td>
                    <td>" . $row['chit_name'] . "</td>
                    <td>" . ($row['auctionstatus'] ? 'TRUE' : 'FALSE') . "</td>
                    <td>" . $row['monthlypay'] . "</td>
                    <td>" . $row['kasar'] . "</td>
                    <td>" . $row['commission_percent'] . "</td>
                    <td>" . $row['amount_bidded'] . "</td>
                    <td>" . $row['current_month'] . "</td>
                    <td>" . $row['total_members'] . "</td>
                    <td>" . $row['customer_bidded'] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No schemes found for this customer.";
    }

    mysqli_close($con);
}
?>

<?php
    if(isset($_POST['bid']))
    {
    //The chit id and the customer is stored here 
    $chit_id=$_POST['chit_id'];
    $customer_id=$_POST['customer_id'];
    //Establish database connection
    $con= new mysqli("localhost","root","root789","chit_fund3");
    if($con->connect_error)
    {
        die("connection error".$con->connect_error);
    }
    //$con=mysqli_connect("localhost","root","root123","chit_fund");
    //Setting queires to check scheme is exists
    //$query1="select * from ongoing_scheme where chit_id = ? ";
    //$query=mysqli_query($con,"select * from ongoing_schemes where customer");
    $stmt=$con->prepare("select * from ongoing_scheme where chit_id = ? ");
    $stmt->bind_param("s",$chit_id);
    $stmt->execute();
    $stmt->store_result();
    $schemeexist=$stmt->num_rows;
    if($schemeexist==0)
    {
        echo "<script> alert('Invalid scheme id') </script>";
    }
    //if()
    //$result1=mysqli_query($con,$query1);
    //echo stringify($result1);
    //$count1=mysqli_num_rows($result1);
    //Checking whether scheme exists
    // $schemeexist=true;
    /*if(!$schemeexist)
    {
        echo "<script> alert($count1) </script>";
        exit();
    }/*
    else
    {
        $schemeexist=0;
    }
    if($count1==0)
    {
        echo " <script> alert('Invalid scheme id') </script>  ";
        exit();
    }
    //Setting counter variable
    /*
    $schemeexist;
    if($count1>0)
    {
        $schemeexist=true;
    }
    else
    {
        $schemeexist=false;
    }
    //
    if($schemeexist == false) 
    {
        echo "<script>alert('Invalid scheme id');</script>";
        exit();
    }
    */
    else
    {      
    $query2 = "SELECT * from scheme_slots 
                WHERE chit_id='$chit_id' and 
                member1 = '$customer_id' OR member2 = '$customer_id' OR member3 = '$customer_id' OR
                member4 = '$customer_id' OR member5 = '$customer_id' OR member6 = '$customer_id' OR
                member7 = '$customer_id' OR member8 = '$customer_id' OR member9 = '$customer_id' OR
                member10 = '$customer_id' OR member11 = '$customer_id' OR member12 = '$customer_id' OR
                member13 = '$customer_id' OR member14 = '$customer_id' OR member15 = '$customer_id' OR
                member16 = '$customer_id' OR member17 = '$customer_id' OR member18 = '$customer_id' OR
                member19 = '$customer_id' OR member20 = '$customer_id' OR member21 = '$customer_id' OR
                member22 = '$customer_id' OR member23 = '$customer_id' OR member24 = '$customer_id' OR
                member25 = '$customer_id' OR member26 = '$customer_id' OR member27 = '$customer_id' OR
                member28 = '$customer_id' OR member29 = '$customer_id' OR member30 = '$customer_id'";
    $result=mysqli_query($con,$query2);
    $count2=mysqli_num_rows($result);
    if($count2==0)
    {
        echo "<script> alert('You are not the member of this scheme')</script>";
        exit;
    }

    //Check if auction is going on 
    $query="select auctionstatus from ongoing_scheme where chit_id='$chit_id'";
    $result=mysqli_query($con,$query);

    // Fetching the rows of retrieved object using mysqli_fetch_assoc(object parameter)
    $row=mysqli_fetch_assoc($result);
    if($row['auctionstatus']==0)
    {
        echo "<script> confirm('Auction is not live yet')</script>";
        exit;
    }
    //if already bidded
    $query="select * from customers_bidded where chit_id='$chit_id' and customer_bidded= '$customer_id'";
    $execute=mysqli_query($con,$query);
    if(mysqli_num_rows($execute)>0)
    {
        echo "<script> alert('You have bidded already in this scheme') </script>";
        exit();
    }

    if($count2>0)
    {
        $bid_amount=$_POST['bidded_amount'];

        $query2="select amount_bidded from ongoing_scheme where chit_id='$chit_id'";

        $result=mysqli_query($con,$query2);

        $row=mysqli_fetch_assoc($result);

        if($row['amount_bidded']>$bid_amount)
        {
             
            $update=mysqli_query($con,"update ongoing_scheme set amount_bidded='$bid_amount',customer_bidded ='$customer_id' where chit_id='$chit_id'");
            //$update=mysqli_query($con,"update ongoing_scheme set  where chit_id='$chit_id' ");
            //Retrieving the total amount from the schemes table
            $query="Select totalamount,commissionpercent,totalcount from schemes where chit_id = '$chit_id'";
            $execute=mysqli_query($con,$query);
            $schemedata=mysqli_fetch_assoc($execute);

            $totalamount=$schemedata['totalamount'];

            //Updating kasar amount
            $query="select amount_bidded,commission_percent,total_members from ongoing_scheme where chit_id = '$chit_id'";
            $execute=mysqli_query($con,$query);
            $ongoingdata=mysqli_fetch_assoc($execute);

            //bidded amount after commission
            $ongoingdaata['amount_bidded']=$ongoingdata['amount_bidded']+(($schemedata['totalamount']/100)*$schemedata['commissionpercnet']);

            $kasar=(($schemedata['totalamount']-$ongoingdata['amount_bidded'])/$ongoingdata['total_members']);

            $monthlypay=($schemedata['totalamount']/$schemedata['totalcount'])-$kasar;//+(($schemedata['totalamount']/100)*$schemedata['commissionpercent']);

            $query="update ongoing_scheme set kasar = '$kasar', monthlypay = '$monthlypay' where chit_id='$chit_id'";

            $execute=mysqli_query($con,$query);

        }
        else
        {
            echo "<script> alert('Bid lower amount') </script>";
        }    
        //echo " you are member of this scheme ";
    }
    else
    {
        echo " you're are a not member of this scheme ";
    }
    }
    }
?>

<html>
    <title>Join Chit</title>
    
    <style>
        body {
            font-family: Arial;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        #joinForm {
            display: none;
        }

        pre{
            spacing:10px;
        }
    </style>
<body>

   
    <div id="schemesContainer"></div>
    <form id="bidamountform" method="POST">
    <pre>
    <input type="text" placeholder="Enter the chid id" name="chit_id">
    <input type="hidden" name="customer_id" value="<?php echo $username; ?>">
    <input type="number" placeholder="Bidding amount" name="bidded_amount">
    <input type="submit" name="bid" value="Bid amount"> 
    </pre>
    </form>
<!--
    <form method=post>
        <input type=hidden value=<?php echo $username?>  name=username>
        <input type=submit id=hiddenbutton name=hidden>
        <script>
            document.getElementById('hiddenbutton').click();
        </script>
    </form>
-->
</body>
</html>
