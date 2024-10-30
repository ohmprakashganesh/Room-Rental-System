<?php
session_start();
if (isset($_SESSION['mesg'])) {
    $email = $_SESSION['mesg'];
    $to = $email;
    $subject = 'Code';
    $content = 'Hey, Welcome to Chhaano';
    $headers = "";
    if (mail($to, $subject, $content, $headers)) {
        $_SESSION['mesg']=$email;
            header("Location: SuccessRegistration.php");
        }
    }
else{
    header("Location: Dashboard.php");
}
?>
