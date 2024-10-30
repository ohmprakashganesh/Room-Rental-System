<?php
include "conn.php";
session_start();
$nameErr = '';
$psdErr = '';

if (isset($_POST['submit'])) {
    function Validate($str)
    {
        return trim(htmlspecialchars($str));
    }

    if (empty($_POST['username'])) {
        $nameErr = 'Required';
    } else {
        $name = Validate($_POST['username']);
        if (!preg_match("/^[a-zA-Z0-9_]{6,20}$/", $name)) {
            $nameErr = 'Invalid Name';
        }
    }

    if (empty($_POST['psd'])) {
        $psdErr = 'Required';
    } else {
        $psd = Validate($_POST['psd']);
    }

    if (empty($psdErr) && empty($nameErr)) {
        $sql = "SELECT admin_password FROM admin WHERE admin_name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashedPassword);
            $stmt->fetch();

            if (password_verify($psd, $hashedPassword)) {
                $_SESSION['name'] = $name;


                echo $name;
                header("Location: admin_panel/index.php");
                exit();
            } else {
                header("Location: aLogin.php?error=1");
                exit();
            }
        } else {
            header("Location: aLogin.php?error=1");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="CSS/alogin.css">
</head>
<body>
<div id="main-container">
    <h2>Log In</h2>
    <form action="" method="post">
        <div class="error">
            <?php
            if (isset($_GET['error'])) {
                echo "Username and Password Invalid!!";
            }
            ?>
        </div>
        <div id="input-area">
            <div id="name">
                <input type="text" name="username" id="name" placeholder="Name"
                       value="<?php echo isset($name) ? $name : ''; ?>">
                <div id="nameErr" class="error"><?php echo $nameErr; ?></div>
            </div>
            <div id="password">
                <input type="password" name="psd" id='psd' placeholder="PassWord"
                       value="<?php echo isset($psd) ? $psd : ''; ?>">
                <div id="psdErr" class="error"><?php echo $psdErr; ?></div>
            </div>
        </div>
            <a href="">
                <button type="submit" name="submit" class="button-submit">LOG IN</button>
            </a>
    </form>
</div>
</body>
<script>
    document.getElementById('name').addEventListener('input',function(){
        document.getElementById('nameErr').innerHTML='';
    });
    document.getElementById('psd').addEventListener('input',function(){
        document.getElementById('psdErr').innerHTML='';
    });
</script>
</html>