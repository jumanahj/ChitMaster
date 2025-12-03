<?php
if(isset($_POST['mysubmit'])) {
    $us = $_POST['username'];
    $pw = $_POST['password'];
    $transaction_id = $_POST['transaction_id'];
   // echo "The received username is " . $us;
   // echo "The received password is " . $pw;
    //echo "The received transaction is " . $transaction_id;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two Columns with Form Submission</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }
        .container {
            display: flex;
            height: 100vh;
            width: 100%;
        }
        .column {
            padding: 20px;
            box-sizing: border-box;
        }
        .left {
            flex: 0 0 300px;
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 10px 0 0 10px;
            overflow-y: auto;
        }
        .right {
            flex: 1;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 0;
            overflow: hidden;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 10px;
            text-align: center;
            color: #fff;
        }
        iframe {
            border: none;
            width: 100%;
            height: 100%;
        }
        .btn-primary {
            background-color: rgba(255, 255, 255, 0.2);
            border: none;
            color: #fff;
            display: inline-block;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            width: 100%;
            box-sizing: border-box;
        }
        .btn-primary:hover {
            background-color: rgba(255, 255, 255, 0.4);
        }
        .dropdown {
            position: relative;
            display: inline-block;
            width: 100%;
        }
        .dropdown-toggle {
            width: 100%;
            text-align: left;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: rgba(0, 0, 0, 0.9);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            width: 100%;
        }
        .dropdown:hover .dropdown-menu {
            display: block;
        }
        .dropdown-menu a {
            color: #fff;
            padding: 10px;
            display: block;
            text-decoration: none;
        }
        .dropdown-menu a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="column left">
            <table class="table">
                <tr>
                    <td>ID: <?php echo $us; ?></td>
                </tr>
                <tr>
                    <td>
                        <form method="post" action="company_create_scheme (2).php" target="displayframe"> 
                            <input type="hidden" value="<?php echo $transaction_id ?>" name="transaction_id">
                            <input type="submit" value="CREATE SCHEME" name="create_scheme" class="btn-primary">
                        </form> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <form method="post" action="company_current_scheme (1).php" target="displayframe"> 
                            <input type="hidden" value="<?php echo $transaction_id ?>" name="transaction_id">
                            <input type="submit" value="SCHEMES" name="create_scheme" class="btn-primary">
                        </form> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <a target="displayframe" href="company_live_scheme (1).php" class="btn-primary">LIVE SCHEMES</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="dropdown">
                            <button class="btn-primary dropdown-toggle" type="button"><center>Manage Schemes</center>
                                <span class="caret"></span>
                            </button>
                            <div class="dropdown-menu">
                                <a href="company_start_scheme (3).php" target="displayframe">Start Schemes</a>
                                <a href="company_end_scheme (1).php" target="displayframe">End Schemes</a>
                                <a href="company_start_auction (2).php" target="displayframe">Start Auctions</a>
                                <a href="company_end_auction (1).php" target="displayframe">End Auctions</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="company_users_list (1).php" target="displayframe" class="btn-primary">CUSTOMER DETAILS</a>       
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="company_receipts (1).php" target="displayframe" class="btn-primary">RECEIPTS</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="company_transaction (1).php" target="displayframe" class="btn-primary">TRANSACTIONS</a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="column right">
            <iframe name="displayframe" id="displayframe"></iframe>
        </div>
    </div>
</body>
</html>
