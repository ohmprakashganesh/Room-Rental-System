<?php
include('Conn.php');
session_start();
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $to = $email;
    $subject = 'Code';
    $content = rand(100000, 999999);
    $headers = "";

    if (mail($to, $subject, $content, $headers)) {
        $sql = "UPDATE login SET code='$content' WHERE email='$email'";
        if ($conn->query($sql)) {
            $_SESSION['email']=$email;
            header("Location: EmailConfirmation.php");
        }
    }
} else {
    header("Location: Forgot.php");
}
?>










