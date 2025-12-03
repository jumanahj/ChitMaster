<?php

if(isset($_POST['end']))
{
    $chit_id=$_POST['chit_id'];
    $con=mysqli_connect("localhost","root","root789","chit_fund3");

    $query="select chit_name,commission_percent,total_members,totalamount from ongoing_scheme where chit_id = '$chit_id' ";

    $execute=mysqli_query($con,$query);

    $chit_details=mysqli_fetch_assoc($execute);

    $chit_name=$chit_details['chit_name'];
    $commission_percent=$chit_details['commission_percent'];
    $totalmembers=$chit_details['total_members'];
    $totalamount=$chit_details['totalamount'];

    $query="insert into ended_scheme (chit_id,chit_name,commission_percent,total_members,total_amount) 
    values('$chit_id','$chit_name','$commission_percent','$totalmembers','$totalamount') ";


    $execute=mysqli_query($con,$query);
    if($execute)
    {
        echo " <script>  alert('Scheme ended    ') </script> ";
    }
}


?>



<html>


<h1> Schemes to be ended </h1>

    <form method="post">
        <label for="Enter the chid if">Enter the chit id </label>
        <input type=text name=chit_id>
        <input type=submit name=end value=end>
    </form>

</html>