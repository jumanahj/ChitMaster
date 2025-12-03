<?php
if (isset($_POST['log'])) {
    $con = mysqli_connect("localhost", "root", "root789", "chit_fund3") or die("connection failed");
    $un = $_POST['username'];
    $pw = $_POST['password'];

    $query = "select * from users where username = '$un' and pass = '$pw'";
    $result = mysqli_query($con, $query);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
?>
<html>
<body>
<form method='post' action='user_main_page.php' id='hiddenform' target='main_page.html'>
<input type=hidden value='<?php echo $un; ?>' name=username>
<input type=hidden value='<?php echo $pw; ?>' name=password>
<input type=submit name='mysubmit' id='hidden'>
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
    <title>Customer Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #141E30, #243B55);
            font-family: 'Poppins', sans-serif;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            width: 400px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        .login-container h1 {
            font-size: 30px;
            color: #FFFFFF;
            text-align: center;
            margin-bottom: 20px;
            opacity: 0.9;
        }
        .login-container label {
            font-size: 16px;
            color: #FFFFFF;
            margin-bottom: 5px;
        }
        .login-container input {
            margin-bottom: 20px;
            border-radius: 5px;
            padding: 10px;
            border: 1px solid #ddd;
        }
        .login-container .btn {
            background: #FFFFFF;
            color: #141E30;
            font-size: 16px;
            border-radius: 5px;
            width: 100%;
            margin-bottom: 10px;
        }
        .login-container a {
            font-size: 14px;
            color: #FFFFFF;
            text-decoration: underline;
            display: block;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Customer Login</h1>
        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="log">Login</button>
            <a href="#">Forgot password?</a>
            <a href="user_signup_form.html" target="main_page.html">Don't have an account? <b>Register</b></a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
