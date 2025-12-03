<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #d3d3d3; 
        }
        .form-container {
            background-color: #333; 
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
            color: #fff;
        }
        .form-container h2 {
            margin-bottom: 20px;
        }
        .form-container input[type="text"],
        .form-container input[type="date"],
        .form-container input[type="mail"],
        .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-container input[type="text"],
        .form-container input[type="date"],
        .form-container input[type="mail"] {
            background-color: #555; 
            color: #fff; 
        }
        .form-container input[type="submit"] {
            background-color: #444; 
            color: white;
            border: none;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Forgot Password</h2>
        <form action="user_verify_password.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="date" name="dob" placeholder="Date of Birth" required>
            <input type="mail" name="mail" placeholder="Email" required>
            <input type="submit" name="submit" value="Verify">
        </form>
    </div>
</body>
</html>
