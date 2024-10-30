<?php
session_start();
if(!isset($_SESSION['mail'])){
    header('Location:Home.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/login.css">
</head>
<bo>
<div class="container">
    <div class="motto">
            <img src="IMAGE/Room.jpg" alt="Room Picture">
            <h3>FEEL LIKE HOME.</h3>
            <p>Chhaano Room Renting System</p>
        </div>
        <div class='formbox'>
        <div class='logo'>
            <div id='image'><img src="IMAGE/logo_transparent.png" alt=""></div>
            <div id='tag'><h2>CHHAANO</h2></div>
          </div>
            <p>Hey, <?php  if(isset($_SESSION['mail'])) echo $_SESSION['mail'];?></p>
            <h3>Please, check email from CHHAANO.</h3>
            <div class="btn">
            <a href='login.php'><input type="submit" value="Go Back"></a>
            </div>
        </div>
</div>
</body>
</html>