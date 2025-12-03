<?php
$username = '';
if (isset($_POST['joinscheme'])) {
    $username = $_POST['username'];  
}
?>
<?php
if (isset($_POST['join'])) {
    $username = $_POST['customer_id'];
    $con = mysqli_connect("localhost", "root", "root789", "chit_fund3") or die("connection failed");
    $chit_id = $_POST['chit_id'];

    // checking whether scheme exist
    $query1 = "SELECT * FROM schemes WHERE chit_id = '$chit_id'";
    $result1 = mysqli_query($con, $query1);
    $count1 = mysqli_num_rows($result1);

    if ($count1 > 0) {   
        // if scheme exists
        $query2 = "SELECT * FROM scheme_slots WHERE chit_id = '$chit_id' AND opened = true";
        $result2 = mysqli_query($con, $query2);
        $count2 = mysqli_num_rows($result2);

        // check whether scheme exist and opened
        if ($count2 == 0) {
            // if not opened
            echo "<script> alert('The scheme slots is currently closed') </script>";
            exit;
        } else {
            // if opened
            $row = $result2->fetch_assoc();

            // Check if the scheme is already full
            if ($row['currentcount'] >= $row['count']) {
                echo "<script> alert('The scheme has reached its maximum count') </script>";
                exit;
            }

            // Check if the user is already enrolled in the scheme
            $isMember = false;
            for ($i = 1; $i <= 30; $i++) {
                $member = 'member' . $i;    
                if ($row[$member] == $username) {
                    $isMember = true;
                    break;
                }
            }

            if ($isMember) {
                echo "<script> alert('You have already joined this scheme') </script>";
                exit;
            } else {
                // Enroll the user if not already a member
                for ($i = 1; $i <= 30; $i++) {
                    $member = 'member' . $i;    
                    if (empty($row[$member])) {
                        $insert = "UPDATE scheme_slots SET $member = '$username' where chit_id = '$chit_id'";
                        $result3 = mysqli_query($con, $insert);
                        if ($result3) {
                            $new_current_count = $row['currentcount'] + 1;
                            $update_count = "UPDATE scheme_slots SET currentcount = $new_current_count WHERE chit_id = '$chit_id'";
                            $result4 = mysqli_query($con, $update_count);
                            
                            if ($result4) {
                                echo "Enrolled in the scheme.";
                            } else {
                                echo "Error occurred while updating the current count.";
                            }
                        } else {
                            echo "Error occurred while updating slot";
                        }
                        break;
                    }
                }
            }
        } 
    } else {
        // When the scheme itself doesn't exist
        echo "<script>alert('Invalid Scheme Id')</script>";
    }
    // Close connection
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Chit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #d3d3d3; /* Light grey background */
            margin: 0;
            padding: 20px;
            
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #333; /* Dark grey background */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            color: #fff; /* White text */
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: calc(100% - 12px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            color: #333; /* Dark grey text */
        }
        button {
            padding: 10px 20px;
            background-color: #555; /* Grey background */
            color: #fff; /* White text */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #777; /* Lighter grey on hover */
        }
        h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Join Scheme</h2>
    <form method="POST">
        <div class="form-group">
            <label for="chit_id">Chit ID:</label>
            <input type="text" id="chit_id" name="chit_id" required>
        </div>
        <div class="form-group">
            <input type="hidden" id="customer_id" value="<?php echo $username; ?>" name="customer_id" required>
        </div>
        <button type="submit" name="join">Join</button>
    </form>
</div>

</body>
</html>
