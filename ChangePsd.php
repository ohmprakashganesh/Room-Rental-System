<?php
session_start();
if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    if(empty($email)) {
        header("Location:EmailConfirmation.php");
    }
    if(isset($_POST['Change'])) {
        include 'Conn.php';
        $psd = $_POST['psd'];
        $cpsd = $_POST['cpsd'];
        $hashedPsd = password_hash($psd, PASSWORD_DEFAULT);
        if(!empty($psd) && !empty($cpsd)) {
            $sql = "update login set password='$hashedPsd' where email='$email'";
        }
        if($conn->query($sql) === true) {
            session_unset();
            header("Location:SuccessChange.php");
        }
    }
}
else{
  header('Location:login.php');
}
?>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <link rel="stylesheet" href="CSS/login.css" />
  </head>
  <body>
    <div class="container">
    <div class="motto">
            <img src="IMAGE/Room.jpg" alt="Room Picture">
            <h3>FEEL LIKE HOME</h3>
            <p>Chhaano Room Renting System</p>
        </div>
      <div class="formbox">
      <div class='logo'>
            <div id='back'><a href="EmailConfirmation.php"><span>&#8592;</span></a></div>
            <div id='image'><img src="IMAGE/logo_transparent.png" alt=""></div>
            <div id='tag'><h2>CHHAANO</h2></div>
          </div>
      <div class="inputbox">
        <form  method="post"onsubmit="return Verify();">
        <div class="input-group">
          <h3><b>Reset Your Password</b></h3>
          <div>
            <?php 
            if(isset($error)){
              echo "Code is EMPTY!";
            }
            ?>
          </div>
            <div class="formdesign" id="password">
              <input type="Password" placeholder="New Password " id="psd" name="psd"/><br>
               <p id="error1" class="error formerror"></p>
              <input type="Password" placeholder="Confirm Password " id="cpsd" name="cpsd"/><br>
              <p class="error formerror" id="error2"></p>
              </div>  
          <div class="btn">
          <input type="submit" value="Change Password" name="Change">
          </div>
        </form>
      </div>
    </div>
  </body>
  <script>
    function seterror(id,error){
    var ele=document.getElementById(id);
    ele.getElementsByClassName("formerror")[0].innerHTML=error;

}
function clearerr(){
    errors=document.getElementsByClassName('formerror');
    for(let item of errors){
        item.innerHTML= "";
    }
}
    function Verify(){
      clearerr();
     let returnval;
      pass=document.getElementById('psd').value.trim();
      cpass=document.getElementById('cpsd').value.trim();
      if(pass== ""){
        seterror('pass','*Required');
            returnval= false;
        }
        else{
        if(pass.length <8){
          seterror('pass','*Required Length(8)');
            returnval= false;
        }
       }
       if(cpass== ""){
        seterror('cpass','*Required');
            returnval= false;
        }
        else{
        if(cpass.length <8){
          seterror('cpass','*Required Length(8)');
            returnval= false;
        }
        else if(cpass!=pass){
          seterror('cpass','Password not Matched');
            returnval= false;

        }
       }
       return returnval;
    }
  </script>
</html>