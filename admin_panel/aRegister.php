<?php
session_start();
$nameErr = '';
$fnameErr = '';
$psdErr = '';
$cpsdErr = '';

if (isset($_POST['submit'])) {
    include 'Conn.php';

    function Validate($str)
    {
        return trim(htmlspecialchars($str));
    }
    if (empty($_POST['username'])) {
        $nameErr = 'Required';
    } else {
        $name = Validate($_POST['username']);
        if (strlen($name) < 6) {
            $nameErr = 'Minimum Length(6) Required';
        } elseif (!preg_match("/^[a-zA-Z0-9_]{6,20}$/", $name)) {
            $nameErr = 'Invalid Name';
        }
    }
    if (empty($_POST['fullname'])) {
        $fnameErr = 'Required';
    } else {
        $fname = Validate($_POST['fullname']);
        if (strlen($fname) < 6) {
            $fnameErr = 'Minimum Length(6) Required';
        } elseif (!preg_match("/^[A-Za-z\s'-]+$/", $fname)) {
            $fnameErr = 'Invalid Name';
        }
    }

    if (empty($_POST['psd'])) {
        $psdErr = 'Required';
    } else {
        $psd = Validate($_POST['psd']);
        if (strlen($psd) < 8) {
            $psdErr = 'Minimum Length(8) Required';
        }
    }
    if (empty($_POST['cpsd'])) {
        $cpsdErr = 'Required';
    } else {
        $cpsd = Validate($_POST['cpsd']);
        if ($cpsd !== $psd) {
            $cpsdErr = 'Passwords do not match';
        }
    }



    $checkSql = "SELECT admin_name FROM admin WHERE admin_name = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("s", $name);
    $checkStmt->execute();
    $checkStmt->store_result();
    if ($checkStmt->num_rows > 0) {
        $nameErr = 'Username already exists';
    }
    if (empty($psdErr) && empty($nameErr) && empty($fnameErr) && empty($cpsdErr)) {
        $hashedPassword = password_hash($psd, PASSWORD_DEFAULT);
        $sql = "INSERT INTO admin(admin_name, admin_fname, admin_password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $fname, $hashedPassword);
        if ($stmt->execute()) {
            header("Location:asuccReg.php");
        } else {
            echo 'Registration failed';
        }
    }
}




    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register</title>
    <link rel="stylesheet" href="CSS/alogin.css">
</head>
<body>
<div id="main-container">
    <form action="" method="post" id="mform">
        <h2>Sign Up</h2>
        <div class="error">
            <?php
            if (isset($_GET['error'])) {
                echo "Username Already Taken!";
            }
            ?>
        </div>
        <div id="input-area">
            <div id="name">
                <input type="text" name="username" id="uname" placeholder="UserName"
                       value="<?php echo isset($name) ? $name : ''; ?>" onkeypress="validateName()">
                <div id="nameErr" class="error"><?php echo $nameErr; ?></div>
            </div>
            <div id="name">
                <input type="text" name="fullname" id="fname" placeholder="Full Name"
                       value="<?php echo isset($fname) ? $fname : ''; ?>">
                <div id="fnameErr" class="error"><?php echo $fnameErr; ?></div>
            </div>
            <div id="password">
                <input type="password" name="psd" id='psd' placeholder="PassWord"
                       value="<?php echo isset($psd) ? $psd : ''; ?>">
                <div id="psdErr" class="error"><?php echo $psdErr; ?></div>
            </div>
            <div id="password">
                <input type="password" name="cpsd" id='cpsd' placeholder="Confirm PassWord"
                       value="<?php echo isset($cpsd) ? $cpsd : ''; ?>">
                <div id="cpsdErr" class="error"><?php echo $cpsdErr; ?></div>
            </div>
        </div>
        <button type="submit" name="submit" class="button-submit">Register</button>
    </form>
</div>
</body>
<script>
    document.getElementById('uname').addEventListener('input',function(){
        document.getElementById('nameErr').innerHTML='';
    });
    document.getElementById('fname').addEventListener('input',function(){
        document.getElementById('fnameErr').innerHTML='';
    });
    document.getElementById('psd').addEventListener('input',function(){
        document.getElementById('psdErr').innerHTML='';
    });
    document.getElementById('cpsd').addEventListener('input',function(){
        document.getElementById('cpsdErr').innerHTML='';
    });

    function validateName()
{
        console.log('yes');
    var request=new XMLHttpRequest();
    request.open('POST','ValidateUsername.php');
    request.onreadystatechange=function(){
        if(this.readyState===4 && this.status===200){
            var status=this.responseText;
            if(status=='Username Available'){
                console.log(status);
                document.getElementById('nameErr').style.color='Green';
            }
            else{
                document.getElementById('nameErr').style.color='red';
            }
            console.log(status);
            document.getElementById('nameErr').innerHTML=status;
        }
    };
    var myForm=document.getElementById('mform');
    var form=new FormData(myForm);
    request.send(form);
}
</script>
</html>