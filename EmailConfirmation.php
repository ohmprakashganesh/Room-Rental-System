<?php
session_start();
if(isset($_SESSION['email'])) {
   if(isset($_POST['submit'])) {
    $email=$_SESSION['email'];
    $code = $_POST['code'];
    include 'Conn.php';
    $sql="select code from login where email='$email'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if($code==$row['code']) {
        $_SESSION['email']=$email;
        header("Location:ChangePsd.php");
    } else {
        header("Location:EmailConfirmation.php?err=1");
    }
   }


} else {
  echo "session is not set";
}







?>
<html>
  <head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <link rel="stylesheet" href="CSS/login.css" />
    <script src="https://kit.fontawesome.com/f0ff125fe7.js" crossorigin="anonymous"></script>
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
            <div id='back'><a href="Forgot.php"><span>&#8592;</span></a></div>
            <div id='image'><img src="IMAGE/logo_transparent.png" alt=""></div>
            <div id='tag'><h2>CHHAANO</h2></div>
          </div>
        <div class="inputbox">
        <form  method="post"> 
          <h3>Verify your identity</h3>
          <?php if (isset($_SESSION['email'])): ?>
            <p>We've just sent a code to<b> <?php echo $_SESSION['email']; ?></b>
            .<br>Check your emails for a message from the CHHAANO team, and enter the code here.</p>
          <?php endif; ?>
          <div class="formdesign" id="code">
            <input type="text" placeholder="Code " id="code" name="code"/>
            <p id="err1" class="error">
              <?php
              if(isset($_GET['err'])){
                echo "Confirmation Code didnot Match";
              }
            ?>
            <div class="btn">
              <input type="submit"  id="code" name="submit" value="Enter"/>
            </div>
            </p>
          </div>
        </form>
        </div>
      </div>
    </div>
    </div>
  </body>
</html>