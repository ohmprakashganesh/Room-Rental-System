<?php
session_start();
if(isset($_SESSION['uid'])){
    header('Location:User.php');
}
if (isset($_POST['Login'])) {
    include 'Conn.php';

    $email = $_POST['email'];
    $psd = $_POST['psd'];

    $sql = "SELECT password FROM login WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        if (password_verify($psd, $hashedPassword)) {
            echo 'yes';
            $_SESSION['uid'] = $email;
            $_SESSION['id'] = $id;
            header("Location: User.php");
        } else {
            header("Location: LoginUser.php?error=1");
        }
    } else {
        header("Location: LoginUser.php?err=1");
        exit();
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/login.css">
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
                <div id='image'><img src="IMAGE/logo.png" alt=""></div>
                <div id='tag'><h2>CHHAANO</h2></div>
            </div>
            <h3>Log In</h3>
            <div class="inputbox">
                <form name="myform" method="post" onsubmit="return validateform();">
                    <div class="error">
                        <?php
                        if (isset($_GET['error'])) {
                            echo "Invalid email or password!";
                        }
                        ?>
                        <?php
                        if (isset($_GET['err'])) {
                            echo "Email not Registered!";
                        }
                        ?>
                    </div>
                    <div class="formdesign" id="email">
                        <input type="email" name="email" placeholder="Enter Email Address">
                        <p class="formerror error"></p>
                    </div>
                    <div class="formdesign" id="pass">
                        <input type="password" name="psd" placeholder="Enter Password">
                        <p class="formerror error"></p>
                    </div>
                    <div class="frg-btnn">
                        <a href="Forgot.php">Forgot Password?</a>
                    </div>
                    <div class="btn">
                        <input type="submit" value="Log In" name="Login">
                    </div>
                    <div class="new-btnn">
                        <a href="signup.php">Don't Have an Account?</a>
                    </div>
                </form>
            </div>
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
    function validateform(){
        clearerr();
        var returnval=true;
        var email = document.forms['myform']['email'].value;
        var pass = document.forms['myform']['psd'].value;

       
        if(email== ""){
            seterror("email","*Required");
            returnval= false;
        }
        else{
            if(!/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(email)){
          seterror("email","*Invalid Email");
          returnval=false;
        }
        }
        if(pass== ""){
            seterror("pass","*Required");
            returnval= false;
        }
        return returnval;
    }
    function clearError(id) {
  seterror(id, '');
}
document.forms['myform']['email'].addEventListener('input', function() {
  clearError('email');
});

document.forms['myform']['psd'].addEventListener('input', function() {
  clearError('pass');
});

</script>
</html>