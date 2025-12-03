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

        $query = " SELECT  os.chit_id, os.chit_name, os.auctionstatus, os.monthlypay, os.kasar,  os.commission_percent, os.amount_bidded, os.current_month,  os.total_members, os.customer_bidded, s.transaction_id
        FROM  ongoing_scheme os JOIN  scheme_slots ss ON os.chit_id = ss.chit_id JOIN  schemes s ON os.chit_id = s.chit_id
        WHERE '$username' IN (ss.member1, ss.member2, ss.member3, ss.member4, ss.member5,  ss.member6, ss.member7, ss.member8, ss.member9, ss.member10,  ss.member11, ss.member12, ss.member13, ss.member14, ss.member15, 
                            ss.member16, ss.member17, ss.member18, ss.member19, ss.member20,  ss.member21, ss.member22, ss.member23, ss.member24, ss.member25,   ss.member26, ss.member27, ss.member28, ss.member29, ss.member30);";



        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "
            <div style='background-color: #f0f0f0; padding: 20px;'>
                <table style='width:100%; border-collapse:collapse; margin-bottom:20px; background-color:#333; color:#fff;'>
                        <tr>
                            <th style='border:1px solid #fff; padding:10px; text-align:left;'>Chit ID</th>
                            <th style='border:1px solid #fff; padding:10px; text-align:left;'>Chit Name</th>
                            <th style='border:1px solid #fff; padding:10px; text-align:left;'>Auction Status</th>
                            <th style='border:1px solid #fff; padding:10px; text-align:left;'>Monthly Pay</th>
                            <th style='border:1px solid #fff; padding:10px; text-align:left;'>Kasar</th>
                            <th style='border:1px solid #fff; padding:10px; text-align:left;'>Commission Percent</th>
                            <th style='border:1px solid #fff; padding:10px; text-align:left;'>Amount Bidded</th>
                            <th style='border:1px solid #fff; padding:10px; text-align:left;'>Current Month</th>
                            <th style='border:1px solid #fff; padding:10px; text-align:left;'>Total Members</th>
                            <th style='border:1px solid #fff; padding:10px; text-align:left;'>Customer Bidded</th>
                            <th style='border:1px solid #fff; padding:10px; text-align:left;'>Transaction ID</th>
                        </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td style='border:1px solid #fff; padding:10px; text-align:left;'>" . $row['chit_id'] . "</td>
                        <td style='border:1px solid #fff; padding:10px; text-align:left;'>" . $row['chit_name'] . "</td>
                        <td style='border:1px solid #fff; padding:10px; text-align:left;'>" . ($row['auctionstatus'] ? 'TRUE' : 'FALSE') . "</td>
                        <td style='border:1px solid #fff; padding:10px; text-align:left;'>" . $row['monthlypay'] . "</td>
                        <td style='border:1px solid #fff; padding:10px; text-align:left;'>" . $row['kasar'] . "</td>
                        <td style='border:1px solid #fff; padding:10px; text-align:left;'>" . $row['commission_percent'] . "</td>
                        <td style='border:1px solid #fff; padding:10px; text-align:left;'>" . $row['amount_bidded'] . "</td>
                        <td style='border:1px solid #fff; padding:10px; text-align:left;'>" . $row['current_month'] . "</td>
                        <td style='border:1px solid #fff; padding:10px; text-align:left;'>" . $row['total_members'] . "</td>
                        <td style='border:1px solid #fff; padding:10px; text-align:left;'>" . $row['customer_bidded'] . "</td>
                        <td style='border:1px solid #fff; padding:10px; text-align:left;'>" . $row['transaction_id'] . "</td>
                      </tr>";
            }
            echo "</table>
            </div>";
        } else {
            echo "No schemes found for this customer.";
        }

        mysqli_close($con);
    }
?>

<?php
    if(isset($_POST['bid']))
    {
         
        $chit_id=$_POST['chit_id'];
        $customer_id=$_POST['customer_id'];
        
        $con= new mysqli("localhost","root","root789","chit_fund3");
        if($con->connect_error)
        {
            die("connection error".$con->connect_error);
        }
        
        $stmt=$con->prepare("select * from ongoing_scheme where chit_id = ? ");
        $stmt->bind_param("s",$chit_id);
        $stmt->execute();
        $stmt->store_result();
        $schemeexist=$stmt->num_rows;
        if($schemeexist==0)
        {
            echo "<script> alert('Invalid scheme id') </script>";
        }
        
        else
        {      
        $query2 = "SELECT * from scheme_slots  WHERE chit_id='$chit_id' and  member1 = '$customer_id' OR member2 = '$customer_id' OR member3 = '$customer_id' OR
                    member4 = '$customer_id' OR member5 = '$customer_id' OR member6 = '$customer_id' OR member7 = '$customer_id' OR member8 = '$customer_id' OR member9 = '$customer_id' OR
                    member10 = '$customer_id' OR member11 = '$customer_id' OR member12 = '$customer_id' OR member13 = '$customer_id' OR member14 = '$customer_id' OR member15 = '$customer_id' OR
                    member16 = '$customer_id' OR member17 = '$customer_id' OR member18 = '$customer_id' OR member19 = '$customer_id' OR member20 = '$customer_id' OR member21 = '$customer_id' OR
                    member22 = '$customer_id' OR member23 = '$customer_id' OR member24 = '$customer_id' OR member25 = '$customer_id' OR member26 = '$customer_id' OR member27 = '$customer_id' OR
                    member28 = '$customer_id' OR member29 = '$customer_id' OR member30 = '$customer_id'";
        $result=mysqli_query($con,$query2);
        $count2=mysqli_num_rows($result);
        if($count2==0)
        {
            echo "<script> alert('You are not the member of this scheme')</script>";
            exit;
        }

 
        $query="select auctionstatus from ongoing_scheme where chit_id='$chit_id'";
        $result=mysqli_query($con,$query);

        
        $row=mysqli_fetch_assoc($result);
        if($row['auctionstatus']==0)
        {
            echo "<script> confirm('Auction is not live yet')</script>";
            exit;
        }
    
        $query="select * from customers_bidded where chit_id='$chit_id' and customer_bidded= '$customer_id'";
        $execute=mysqli_query($con,$query);
        if(mysqli_num_rows($execute)==1)
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
                 
                $query3="update ongoing_scheme set amount_bidded='$bid_amount' where chit_id='$chit_id'";
                $update=mysqli_query($con,$query3);
                $update=mysqli_query($con,"update ongoing_scheme set customer_bidded ='$customer_id' where chit_id='$chit_id' ");
                
                $query="Select totalamount,commissionpercent,totalcount from schemes where chit_id = '$chit_id'";
                $execute=mysqli_query($con,$query);
                $schemedata=mysqli_fetch_assoc($execute);

                $totalamount=$schemedata['totalamount'];

                
                $query="select amount_bidded,commission_percent,total_members from ongoing_scheme where chit_id = '$chit_id'";
                $execute=mysqli_query($con,$query);
                $ongoingdata=mysqli_fetch_assoc($execute);

                $ongoingdaata['amount_bidded']=$ongoingdata['amount_bidded']+(($schemedata['totalamount']/100)*$schemedata['commissionpercent']);

                $kasar=(($schemedata['totalamount']-$ongoingdata['amount_bidded'])/$ongoingdata['total_members']);

                $monthlypay=($schemedata['totalamount']/$schemedata['totalcount'])-$kasar;//+(($schemedata['totalamount']/100)*$schemedata['commissionpercent']);

                $query="update ongoing_scheme set kasar = '$kasar', monthlypay = '$monthlypay' where chit_id='$chit_id'";

                $execute=mysqli_query($con,$query);

                 echo"<script> alert('bidded sucessfully')</script>";

            }
            else
            {
                echo "<script> alert('Bid lower amount') </script>";
            }    
            
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
                background-color: #f0f0f0; 
                color: #333; 
            }
            div.container {
                background-color: #333; 
                padding: 20px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
                background-color: #555; 
                color: #fff; 
                border: 1px solid #fff; 
            }
            th, td {
                padding: 10px;
                text-align: left;
                border: 1px solid #fff; 
            }
            input[type="text"], input[type="number"], input[type="submit"] {
                padding: 8px;
                margin: 5px;
                border: 1px solid #ccc;
                border-radius: 4px;
                background-color: #fff;
                color: #333;
            }
            h2{
               color: #fff;
               }
        </style>
    <body>

        <div class="container">
            <h1>CHITS YOU HAVE ENROLLED</h1>
            
            <div id="schemesContainer"></div>
               <h2> Bid Amount </h2>
            <form id="bidamountform" method="POST">
            <pre>
            <input type="text" placeholder="Enter the chid id" name="chit_id">
            <input type="hidden" name="customer_id" value="<?php echo $username; ?>">
            <input type="number" placeholder="Bidding amount" name="bidded_amount">
            <input type="submit" name="bid" value="Bid amount"> 
            </pre>
            </form>
        </div>
    </body>
    </html>
