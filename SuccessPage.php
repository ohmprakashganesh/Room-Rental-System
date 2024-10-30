<?php
session_start();
if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
    include('conn.php');
    $sql = "SELECT * FROM login WHERE id='$uid'";
    $result = $conn->query($sql);
    $row = $result->fetch_array();
} else {
    header("Location: AddRoom.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Page</title>
    <link rel="stylesheet" href="CSS/Registration.css">
</head>
<body>
    <div id="main-container">
        <fieldset>
            <legend>Success!</legend>
            <div id="form-Box">
                <h2>Your form has been submitted successfully.</h2>
                <p>Thank you for registering the room details.</p>
                <p>You can go back to the <a href="AddRoom.php">Add Room</a> page to add more rooms.</p>
            </div>
        </fieldset>
    </div>
</body>
</html>
