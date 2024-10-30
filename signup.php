<?php
session_start();
if (isset($_POST['Register'])) {
    include 'Conn.php';
    $email = $_POST['email'];
    $name = $_POST['name'];
    $psd = $_POST['psd'];
    $cpsd = $_POST['cpsd'];
    $phone=$_POST['phone'];

    $sql = "SELECT * FROM login WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header("Location: signup.php?err=1");
    } else {
        $hashed_password = password_hash($psd, PASSWORD_DEFAULT);      
        $sql = "INSERT INTO login (name, email, password,phone) VALUES ('$name', '$email', '$hashed_password','$phone')";
        if ($conn->query($sql) === true) {
            $_SESSION['mesg']=$email;
            header("Location: RegMail.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }

    $conn->close();
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
<body>
    <div class="container">
        <div class="motto">
            <img src="IMAGE/Room.jpg" alt="Room Picture">
            <h3>FEELS LIKE HOME.</h3>
            <p>Chhaano Room Renting System</p>
        </div>
        <div class="formbox">
            <div class='logo'>
                <div id='image'><img src="IMAGE/logo_transparent.png" alt=""></div>
                <div id='tag'><h2>CHHAANO</h2></div>
            </div>
            <h3>Sign Up</h3>
            <div class="inputbox">
                <div class="error">
                    <?php
                    if (isset($_GET['err'])) {
                        echo "Email Already Exists";
                    }
                    ?>
                </div>
                <form name="myform" onsubmit="return validateform();" method="post">
                    <div class="formdesign" id="name">
                        <input type="text" name="name" placeholder="Full Name">
                        <p class="formerror error"></p>
                    </div>
                    <div class="formdesign" id="email">
                        <input type="text" name="email" placeholder="Email Address">
                        <p class="formerror error"></p>
                    </div>
                    <div class="formdesign" id="phone">
                        <input type="text" name="phone" placeholder="Phone Number">
                        <p class="formerror error"></p>
                    </div>
                    <div class="formdesign" id="pass">
                        <input type="password" name="psd" placeholder="Password">
                        <p class="formerror error"></p>
                    </div>
                    <div class="formdesign" id="cpass">
                        <input type="password" name="cpsd" placeholder="Confirm Password">
                        <p class="formerror error"></p>
                    </div>
                    <div class="btn">
                        <input type="submit" class="btn" value="Submit" name="Register">
                    </div>
                    <div class="new-btnn">
                        <a href="login.php">Already have an Account?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
function validateform() {
    clearerr();
    var returnval = true;

    var name = document.forms['myform']['name'].value.trim();
    var email = document.forms['myform']['email'].value.trim();
    var pass = document.forms['myform']['psd'].value.trim();
    var cpass = document.forms['myform']['cpsd'].value.trim();
    var phone = document.forms['myform']['phone'].value.trim();

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

    if (email === "") {
        seterror("email", "*Required");
        returnval = false;
    } else if (!/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(email)) {
        seterror("email", "*Invalid Email");
        returnval = false;
    }

    if (pass === "") {
        seterror("pass", "*Required");
        returnval = false;
    } else if (pass.length < 8) {
        seterror("pass", "*Required Length(8)");
        returnval = false;
    }

    if (cpass === "") {
        seterror("cpass", "*Required");
        returnval = false;
    } else if (cpass !== pass) {
        seterror("cpass", "Password Not Matched");
        returnval = false;
    }

    if (phone === "") {
        seterror("phone", "*Required");
        returnval = false;
    } else if (!/^(?:\+977|0)?[1-9]\d{9}$/.test(phone)) {
        seterror("phone", "*Invalid Phone Number");
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

document.forms['myform']['email'].addEventListener('input', function() {
    clearError('email');
});

document.forms['myform']['psd'].addEventListener('input', function() {
    clearError('pass');
});

document.forms['myform']['cpsd'].addEventListener('input', function() {
    clearError('cpass');
});

document.forms['myform']['phone'].addEventListener('input', function() {
    clearError('phone');
});

document.forms['myform'].addEventListener('submit', function(event) {
    // event.preventDefault();

    var isValid = validateform();

    if (isValid) {
        this.submit();
    }
});
</script>
</html>
