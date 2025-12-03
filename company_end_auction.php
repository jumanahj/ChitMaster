<?php
if(isset($_POST['mysubmit']))
{
    $us = $_POST['username'];
    $pw = $_POST['password'];
    echo "The received username is " . $us ;
    echo "The received password is " . $pw;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Two Columns with Form Submission</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
            height: 100vh;
        }
        .column {
            flex: 1;
            padding: 20px;
            box-sizing: border-box;
        }
        .left {
            flex: 1 1 20%;
            background-color: rgba(0, 0, 0, 0.8);
            overflow-y: auto;
        }
        .right {
            flex: 1 1 80%;
            background-color: rgba(255, 255, 255, 0.2);
            overflow: hidden;
        }
        h1, p {
            margin-bottom: 10px;
        }
        iframe {
            border: none;
            width: 100%;
            height: 100%;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="column left">
            <table border="1">
                <tr>
                    <td>
                        ID: <?php echo $us; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <form action="user_current_scheme.php" target="displayframe">
                            <input type="submit" value="SCHEMES" class="btn-primary">
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>
                        <form method="post" action="user_join_scheme.php" target="displayframe">
                            <input type="hidden" value="<?php echo $us; ?>" name="username">
                            <input type="submit" value="JOIN NEW SCHEME" name="joinscheme" class="btn-primary">
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>
                        <form action="user_search_chit.php" target="displayframe">
                            <input type="submit" value="SEARCH CHIT" class="btn-primary">
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>
                        <form method="post" action="user_my_chits.php" target="displayframe">
                            <input type="hidden" value="<?php echo $us; ?>" name="username">
                            <input type="submit" value="CHITS ENROLLED" name="mychits" class="btn-primary">
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>
                        <form method="post" action="user_receipts.php" target="displayframe">
                            <input type="hidden" value="<?php echo $us; ?>" name="username">
                            <input type="submit" value="RECEIPTS" name="userreceipts" class="btn-primary">
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>
                        <form method="post" action="user_transaction.php" target="displayframe">
                            <input type="hidden" value="<?php echo $us; ?>" name="username">
                            <input type="submit" value="TRANSACTION" name="pay" class="btn-primary">
                        </form>
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
