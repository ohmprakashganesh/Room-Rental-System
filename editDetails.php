<?php
session_start();
if (isset($_SESSION['uid'])) {
    $email = $_SESSION['uid'];
    include 'Conn.php';
    $sql = "SELECT * FROM login WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

    }
    if(isset($_POST['Update'])) {
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $Uemail=$_POST['Email'];
    $sqls = "SELECT * FROM login WHERE email='$Uemail'";
    $results = $conn->query($sqls);
    if($email==$Uemail){
        $sql1="update login set name='$name', phone='$phone' where email='$email'";
        $sql2="Update landlord set lname='$name',lphone='$phone' where lemail='$email'";
        $sql3="Update tenant set tname='$name',tphone='$phone'where temail='$email'";
        if($conn->query($sql1) && $conn->query($sql2) && $conn->query($sql3)){
          header('Location:User.php');
          exit();
        }
    }
    else if ($results && $results->num_rows > 0) {
        $emailError='Email Already Taken';
    }
    else{
        $sql1="update login set name='$name', phone='$phone',email='$Uemail' where email='$email'";
        $sql2="Update landlord set lname='$name',lphone='$phone',lemail='$Uemail' where lemail='$email'";
        $sql3="Update tenant set tname='$name',tphone='$phone',temail='$Uemail'where temail='$email'";
        if($conn->query($sql1) && $conn->query($sql2) && $conn->query($sql3)){
          session_destroy();  
          header('Location:User.php');
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
    <link rel="stylesheet" href="CSS/editDetails.css">
</head>
<body>
        <div class="accessories">
            <h2>Edit Your Details</h2>
            <form name="myform" onsubmit="return validateform();" method="post">
                    <div class="success" style="color: green;"><?php if(isset($success)) echo $success?></div>
                    <div class="formdesign" id="name">
                        <input type="text" name="name" placeholder="Full Name" value="<?php echo $row['name'];?>">
                        <p class="formerror error"></p>
                    </div>
                    <div class="formdesign" id="phone">
                        <input type="text" name="phone" placeholder="Phone Number" value="<?php echo $row['phone']?>">
                        <p class="formerror error"></p>
                    </div>
                    <div class="formdesign" id="Email">
                        <input type="email" name="Email" placeholder="Email Address" value="<?php echo $row['email']?>">
                        <p class="formerror error"></p>
                    </div>
               <div class="btn">
                <input type="submit" value="Save Changes" name='Update'>
               </div>
            </form>
        </div>
</body>
<script>
function validateform() {
    clearerr();
    var returnval = true;

    var name = document.forms['myform']['name'].value.trim();
    var phone = document.forms['myform']['phone'].value.trim();
    var email = document.forms['myform']['Email'].value.trim();
    if (name === "") {
        seterror("name", "*Required");
        returnval = false;
    } else {
        if (name.length > 30) {
            seterror("name", "Limit(30) Exceeded");
            returnval = false;
        } else if (!/^[A-Za-z\s.'-]+$/.test(name)) {
            seterror("name", "*Invalid Name");
            returnval = false;
        }
    }
    if (phone === "") {
        seterror("phone", "*Required");
        returnval = false;
    } else if (!/^(?:\+977|0)?[1-9]\d{9}$/.test(phone)) {
        seterror("phone", "*Invalid Phone Number");
        returnval = false;
    }
    if (email === "") {
        seterror("Email", "*Required");
        returnval = false;
    } else if (!/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(email)) {
        seterror("Email", "*Invalid Email Address");
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
    seterror(id, "");
}

document.forms['myform']['name'].addEventListener('input', function() {
    clearError('name');
});
document.forms['myform']['phone'].addEventListener('input', function() {
    clearError('phone');
});

document.forms['myform'].addEventListener('submit', function(event) {
    var isValid = validateform();

    if (isValid) {
        this.submit();
    }
});
</script>
</html>