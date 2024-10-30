<?php
session_start();

if (isset($_SESSION['uid'])) {
    if (isset($_GET['variable'])) {
        $receivedVariable = urldecode($_GET['variable']);
        if (isset($_POST['proceed'])) {
            $roomno = urlencode($receivedVariable);
            header("Location: AddRequest.php?room=$roomno");
            exit;
        }
    }
}
else{
    header('Location:Dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .confirmation-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        h1 {
            color: #333;
        }
        .confirmation-message {
            margin: 20px 0;
            font-size: 18px;
        }
        .button-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }
        .proceed-button, .cancel-button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
        .proceed-button {
            background-color: #171717;
            color: white;
            border: none;
            margin-right: 10px;
        }
        .cancel-button {
            background-color: white;
            color: rgb(4, 4, 4);
            border: black 1px solid;
        }
    </style>
</head>
<body>
    <div class="confirmation-box">
        <h2>Lets Find you a place to live.</h2>
        <div class="confirmation-message">
            <p>Are you sure you want to rent this room?</p>
        </div>
        <div class="button-container">
            <form method="post">
                <button class="proceed-button" name="proceed">Proceed</button>
            </form>
            <a href="Search.php"><button class="cancel-button">Cancel</button></a>
        </div>
    </div>
</body>
</html>

