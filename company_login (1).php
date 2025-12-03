
<?php
if (isset($_POST['log'])) {
    $con = mysqli_connect("localhost", "root", "root789", "chit_fund3") or die("Connection failed");
    $un = $_POST['username'];
    $pw = $_POST['password'];

    $query = "SELECT * FROM admins WHERE id = '$un' AND pass = '$pw'";
    $result = mysqli_query($con, $query);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        $Admindetails = mysqli_fetch_assoc($result);
        $transaction_id = $Admindetails['transactionid'];
        echo '<script>alert("Login successful.")</script>';
        ?>
        <html>
        <body>
        <form method="post" action="company_main_page (1).php" id="hiddenform" target="_self">
            <input type="hidden" value="<?php echo $un; ?>" name="username">
            <input type="hidden" value="<?php echo $pw; ?>" name="password">
            <input type="hidden" value="<?php echo $transaction_id; ?>" name="transaction_id">
            <input type="submit" name="mysubmit" id="hidden" style="display:none">
        </form>
        <script>
            document.getElementById('hidden').click();
        </script>
        </body>
        </html>
        <?php
    } else {
        echo '<script>alert("Incorrect username or password")</script>';    
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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
        .login-form {
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
        .login-form h1 {
            font-size: 30px;
            color: #FFFFFF;
            text-align: center;
            margin-bottom: 20px;
            opacity: 0.9;
        }
        .login-form label {
            font-size: 16px;
            color: #FFFFFF;
            margin-bottom: 5px;
            display: block;
        }
        .login-form input[type="text"], 
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .login-form input[type="submit"] {
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
        .login-form input[type="submit"]:hover {
            background: #243B55;
            color: #FFFFFF;
        }
        .login-form a {
            font-size: 14px;
            color: #FFFFFF;
            text-decoration: underline;
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="login-form">
    <h1>Admin Login</h1>
    <form method="POST" action="" >
        <div class="form-group">
            <label for="username">Admin ID</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <input type="submit" value="Login" class="btn btn-primary" name="log">
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
