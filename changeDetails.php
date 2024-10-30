<?php
session_start();
if (isset($_SESSION['uid'])) {
    $email = $_SESSION['uid'];
    include 'Conn.php';
    $sql="select * from login where email='$email'";
    $result=$conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
    if(isset($_POST['UpdatePassword'])) {
        $npsd = $_POST['npsd'];
        $psd = $_POST['opsd'];
        $sql = "SELECT password FROM login WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password'];

if (password_verify($psd, $hashedPassword)) {
    $hashedPsd=password_hash($npsd,PASSWORD_DEFAULT);
    $sqli="Update login set password='$hashedPsd' where email='$email'";
    if($conn->query($sqli)===true) {
        session_destroy();
        session_unset();
        header('Location:Dashboard.php');
                }
               }else {
                 $Error='Password Incorrect';
                }
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
    <title>Document</title>
    <link rel="stylesheet" href="CSS/Settings.css">

</head>
<body>
        <div class="accessories accessories2">
            <form name="myform2" onsubmit="return validateform2();" method="post" id='Form'>
            <h2>Change Password</h2>        
            <div class="formdesign" id="opsd">
                        <input type="Password" name="opsd" placeholder="Old Password" onkeyup='return checkPassword();'>
                        <p class="formerror error" id='Error'><?php if(isset($Error)) echo $Error;?></p>
                    </div>
                    <div class="formdesign" id="npsd">
                        <input type="Password" name="npsd" placeholder="New Password">
                        <p class="formerror error"></p>
                    </div>
                    <div class="formdesign" id="cpsd">
                        <input type="Password" name="cpsd" placeholder="Confirm Password">
                        <p class="formerror error"></p>
                    </div>
            <div class="btn">
                <input type="submit" value="Save Changes" name='UpdatePassword'>
            </div>
        </form>
        </div>
</body>
<script>
function validateform2() {
    clearerr();
    var returnval = true;

    var opsd = document.forms['myform2']['opsd'].value.trim();
    var cpsd= document.forms['myform2']['cpsd'].value.trim();
    var npsd = document.forms['myform2']['npsd'].value.trim();
    if (npsd === "") {
        seterror("npsd", "*Required");
        returnval = false;
    } else if (npsd.length < 8) {
        seterror("npsd", "*Required Length(8)");
        returnval = false;
    }

    if (cpsd === "") {
        seterror("cpsd", "*Required");
        returnval = false;
    } else if (cpsd !== npsd) {
        seterror("cpsd", "Password Not Matched");
        returnval = false;
    }
    return returnval;
}
function seterror(id, error) {
    var ele = document.getElementById(id);
    ele.getElementsByClassName("formerror")[0].innerHTML = error;
}

function clearerr() {
    var errors = document.getElementsByClassName('formerror');
    for (var i = 0; i < errors.length; i++) {
        errors[i].innerHTML = "";
    }
}
function clearError(id) {
  seterror(id, '');
}
document.forms['myform2']['opsd'].addEventListener('input', function() {
    clearError('opsd');
});
document.forms['myform2']['npsd'].addEventListener('input', function() {
    clearError('npsd');
});
document.forms['myform2']['cpsd'].addEventListener('input', function() {
    clearError('cpsd');
});
document.forms['myform2'].addEventListener('submit', function(event) {

    var isValid2 = validateform2();

    if (isValid2) {
        this.submit();
    }
});
function checkPassword(){
    var request=new XMLHttpRequest();
    request.open('POST','ValidPassword.php');
    request.onreadystatechange=function(){
        if(this.readyState===4 && this.status===200){
            var status=this.responseText;
            if(status=='Password Correct'){
                console.log(status);
                document.getElementById('Error').style.color='Green';
            }
            else{
                document.getElementById('Error').style.color='red';
            }
            console.log(status);
            document.getElementById('Error').innerHTML=status;
        }
    };
    var myForm=document.getElementById('Form');
    var form=new FormData(myForm);
    request.send(form);
}
</script>
</html>