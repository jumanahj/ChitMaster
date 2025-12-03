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
        $con= mysqli_connect("localhost","root","root123","chit_fund");
        //if($con == false)
        $sec_con=mysqli_connect("localhost","root","root123","transaction");

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
        $query=mysqli_query($sec_con,"insert into month(chit_id,transactionid) values('$id','$TransactionId')");
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


<html>
<head>
    <title>SCHEME CREATION</title>
</head>
<body>
    
<form method="POST">
    <table>
        <tr>
            <td>SCHEME NAME</td>
            <td><input type="text" name="schemename"></td>
        </tr>

        <tr>
            <td>TOTAL AMOUNT</td>
            <td><input text="number" name="totalamount"></td>
        </tr>

        <tr>
            <td>TOTAL MEMBERS</td>
            <td><input type="number" name="totalcount"></td>
        </tr>

        <tr>
            <td>DURATION(MONTHS)</td>
            <td><input type="number" name="schemeduration"></td>
        </tr>

        <tr>
            <td>COMMISSION PERCENT</td>
            <td><input type="number" name="schemecommission"></td>
        </tr>

        </tr>
            <td>TRANSACTION ID</td>
            <td><input type="text" name="transactionid"></td>
        </tr>
        
        <tr>
            <td>EXPECTED STARING DATE</td>
            <td><input type="date" name="startingdate">
        </tr>
        
        <!-- Sending transaction is as hidden input 
         
        <input type="hidden" value='<?php //echo $transaction_id ;?>' name=transaction_id>

        -->

        <tr>
            <td><input type="submit" value=create name="create"></td>
        </tr>
     

    </table>
</form>

</body>
</html>