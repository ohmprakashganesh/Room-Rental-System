<?php
session_start();
if (isset($_POST['submit'])) {
  $email = $_POST['email'];

  if(strlen($email)>0) {
    include('Conn.php');
    $sql = "select * from login where email='$email'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($email==$row['email']) {
      $_SESSION['name']=$row['name'];
      $_SESSION['email']=$email;
      echo $_SESSION['email'];

        header("Location:sendmail.php");
      } 
        else
       {
        header("Location:Forgot.php?error=1");
       }
      }
  else if(empty($email)) {
    header("Location:Forgot.php?message=1");
  }
}



?>
<html>
  <head>
    <title></title>
    <link rel="stylesheet" href="CSS/login.css" />
  </head>
  <body>
<div class="container">
<div class="motto">
            <img src="IMAGE/Room.jpg" alt="Room Picture">
            <h3>FEELS LIKE HOME.</h3>
            <p>Chhaano Room Renting System</p>
        </div>
<div class="formbox">
     <div class='logo'>
            <div id='back'><a href="login.php"><span>&#8592;</span></a></div>
            <div id='image'><img src="IMAGE/logo_transparent.png" alt=""></div>
            <div id='tag'><h2>CHHAANO</h2></div>
       </div>
        <div class="inputbox">
  <form method="post" action="">    
            <div class="formdesign" id="email">
        <h3>We need to verify your identity</h3>
        <p>How would you like to get your security code?</p>
        <input type="email" placeholder="Enter Email Address" id="email" name="email"/>
        <p class="formerror error">
        <?php
       if (isset($_GET['error'])) {
       echo "Email not Found!";
       }
       ?>
       <?php
       if (isset($_GET['message'])) {
       echo "Enter Email Address!";
       }
       ?>
      </p> 
             </div>
                   <div class="btn">
      <input type="submit" value="Send Code" name="submit">
                    </div>
  </form>
</div>
</div>
</div>
</body>
</html>